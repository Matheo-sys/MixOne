<?php

namespace App\Http\Controllers;

use App\Actions\Contact\SendContactEmailAction;
use App\Http\Requests\Contact\ContactRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        private SendContactEmailAction $sendContactEmailAction
    ) {}

    public function show(): View
    {
        return view('emails.contact');
    }

    public function sendEmail(ContactRequest $request): RedirectResponse|JsonResponse
    {
        $this->sendContactEmailAction->execute($request->toDTO());

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'message' => 'Votre message a été envoyé avec succès !']);
        }
        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès!');
    }
}
