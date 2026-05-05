<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutRequest;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = PayoutRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.payouts.index', compact('payouts'));
    }

    public function complete(PayoutRequest $payoutRequest)
    {
        $payoutRequest->update(['status' => 'completed']);
        return back()->with('success', 'Virement marqué comme effectué.');
    }
}
