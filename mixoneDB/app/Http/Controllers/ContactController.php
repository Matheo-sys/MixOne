<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function show()
    {
        return view('emails.contact');
    }

    public function sendEmail(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Données à envoyer par email
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        // Envoyer l'email à ton adresse de support
        Mail::to('mixone.contact@gmail.com')->send(new ContactMail($data));

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès!');
    }
}
