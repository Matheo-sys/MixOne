<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class TestEmailCommand extends Command
{
    protected $signature = 'test:email {email}';
    protected $description = 'Send a test email to verify configuration';

    public function handle()
    {
        $email = $this->argument('email');
        $this->info("Sending test email to {$email}...");

        try {
            Mail::to($email)->send(new ContactMail([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'subject' => 'Test MixOne',
                'message' => 'Ceci est un test de configuration email pour MixOne.'
            ]));
            $this->info("Email sent successfully!");
        } catch (\Exception $e) {
            $this->error("Failed to send email: " . $e->getMessage());
        }
    }
}
