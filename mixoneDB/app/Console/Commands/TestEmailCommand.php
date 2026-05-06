<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class CommandeTestEmail extends Command
{
    /**
     * Le nom et la signature de la commande.
     *
     * @var string
     */
    protected $signature = 'test:email {email}';

    /**
     * La description de la commande.
     *
     * @var string
     */
    protected $description = 'Envoyer un e-mail de test pour vérifier la configuration';

    /**
     * Exécuter la commande.
     */
    public function handle()
    {
        $courriel = $this->argument('email');
        $this->info("Envoi d'un e-mail de test à {$courriel}...");

        try {
            Mail::to($courriel)->send(new ContactMail([
                'name' => 'Utilisateur Test',
                'email' => 'test@example.com',
                'subject' => 'Test MixOne',
                'message' => 'Ceci est un test de configuration email pour MixOne.'
            ]));
            $this->info("E-mail envoyé avec succès !");
        } catch (\Exception $e) {
            $this->error("Échec de l'envoi de l'e-mail : " . $e->getMessage());
        }
    }
}

