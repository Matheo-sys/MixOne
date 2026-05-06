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
    public function index()
    {
        $virements = PayoutRequest::with('utilisateur')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

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

