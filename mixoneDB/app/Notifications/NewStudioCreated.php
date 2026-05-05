<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewStudioCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected \App\Models\Studio $studio;

    public function __construct(\App\Models\Studio $studio)
    {
        $this->studio = $studio;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Nouveau Studio sur MixOne : ' . $this->studio->name)
                    ->greeting('Bonjour Admin,')
                    ->line('Un nouveau studio vient d\'être créé sur la plateforme.')
                    ->line('Nom : ' . $this->studio->name)
                    ->line('Propriétaire : ' . ($this->studio->user->first_name ?? 'Inconnu') . ' ' . ($this->studio->user->last_name ?? ''))
                    ->action('Gérer le studio', route('admin.studios.index'))
                    ->line('N\'oubliez pas de le vérifier pour qu\'il soit visible en ligne.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'studio_id' => $this->studio->id,
            'studio_name' => $this->studio->name,
            'owner_name' => ($this->studio->user->first_name ?? '') . ' ' . ($this->studio->user->last_name ?? ''),
            'message' => 'Nouveau studio créé : ' . $this->studio->name,
        ];
    }
}
