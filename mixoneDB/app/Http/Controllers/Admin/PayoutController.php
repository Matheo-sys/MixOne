<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutRequest;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    /**
     * Liste des demandes de virement.
     */
    public function liste(Request $request)
    {
        $query = PayoutRequest::with('utilisateur');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('utilisateur', function($qUser) use ($search) {
                $qUser->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $virements = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.payouts.index', ['payouts' => $virements]);
    }

    /**
     * Marquer un virement comme effectué.
     */
    public function terminer(PayoutRequest $demandeVirement)
    {
        $demandeVirement->update(['status' => 'completed']);
        return back()->with('success', 'Virement marqué comme effectué.');
    }
}

