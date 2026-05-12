<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Liste des signalements
     */
    public function index(Request $request)
    {
        $query = Report::with(['reporter', 'reported'])->orderBy('created_at', 'desc');

        // Filtre par statut
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Recherche par utilisateur
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('reporter', function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            })->orWhereHas('reported', function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $reports = $query->paginate(15)->withQueryString();

        // Statistiques
        $pendingCount = Report::where('status', 'pending')->count();
        $resolvedCount = Report::where('status', 'resolved')->count();
        $totalCount = Report::count();

        return view('admin.reports.index', compact('reports', 'pendingCount', 'resolvedCount', 'totalCount'));
    }

    /**
     * Affiche les détails d'un signalement, incluant l'historique de la conversation
     */
    public function show(Report $report)
    {
        $report->load(['reporter', 'reported']);

        // Récupérer l'historique complet des messages entre les deux utilisateurs
        $messages = Message::where(function($q) use ($report) {
            $q->where('sender_id', $report->reporter_id)
              ->where('receiver_id', $report->reported_id);
        })->orWhere(function($q) use ($report) {
            $q->where('sender_id', $report->reported_id)
              ->where('receiver_id', $report->reporter_id);
        })->orderBy('created_at', 'asc')->get();

        return view('admin.reports.show', compact('report', 'messages'));
    }

    /**
     * Résoudre le signalement
     */
    public function resolve(Request $request, Report $report)
    {
        $request->validate([
            'action' => 'required|in:ignore,ban_reported,ban_reporter',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $report->status = 'resolved';
        $report->admin_notes = $request->input('admin_notes');
        $report->save();

        $action = $request->input('action');

        if ($action === 'ban_reported') {
            $user = User::find($report->reported_id);
            if ($user && !$user->is_banned) {
                $user->is_banned = true;
                $user->ban_reason = "Banni suite au signalement #" . $report->id;
                $user->save();
            }
        } elseif ($action === 'ban_reporter') {
            $user = User::find($report->reporter_id);
            if ($user && !$user->is_banned) {
                $user->is_banned = true;
                $user->ban_reason = "Banni pour signalement abusif #" . $report->id;
                $user->save();
            }
        }

        return redirect()->route('admin.reports.index')->with('success', 'Le signalement a été résolu.');
    }
}
