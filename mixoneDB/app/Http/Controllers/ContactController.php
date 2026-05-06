<?php

namespace App\Http\Controllers;

use App\Actions\Contact\SendContactEmailAction;
use App\Http\Requests\Contact\ContactRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * @param SendContactEmailAction $actionEnvoiContactMail
     */
    public function __construct(
        private SendContactEmailAction $actionEnvoiContactMail
    ) {}

    /**
     * Affiche la page de contact.
     */
    public function afficher(): View
    {
        return view('emails.contact');
    }

    /**
     * Envoie l'e-mail de contact.
     */
    public function envoyerEmail(ContactRequest $requete): RedirectResponse|JsonResponse
    {
        $this->actionEnvoiContactMail->executer($requete->versDTO());

        if ($requete->ajax()) {
            return response()->json(['status' => 'success', 'message' => 'Votre message a été envoyé avec succès !']);
        }
        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès!');
    }
}

