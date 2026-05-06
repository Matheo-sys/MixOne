<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Studio;

class NewStudioCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Studio
     */
    protected Studio $studio;

    /**
     * Crée une nouvelle instance de notification.
     *
     * @param Studio $studio
     */
    public function __construct(Studio $studio)
    {
        $this->studio = $studio;
    }

    /**
     * Détermine les canaux de notification.
     *
     * @param object $destinataire
     * @return array
     */
    public function via(object $destinataire): array
    {
        return ['mail', 'database'];
    }

    /**
     * Représentation par mail de la notification.
     *
     * @param object $destinataire
     * @return MailMessage
     */
    public function toMail(object $destinataire): MailMessage
    {
        return (new MailMessage)
                    ->subject('Nouveau Studio sur MixOne : ' . $this->studio->name)
                    ->greeting('Bonjour Admin,')
                    ->line('Un nouveau studio vient d\'être créé sur la plateforme.')
                    ->line('Nom : ' . $this->studio->name)
                    ->line('Propriétaire : ' . ($this->studio->proprietaire->first_name ?? 'Inconnu') . ' ' . ($this->studio->proprietaire->last_name ?? ''))
                    ->action('Gérer le studio', route('admin.studios.index'))
                    ->line('N\'oubliez pas de le vérifier pour qu\'il soit visible en ligne.');
    }

    /**
     * Représentation sous forme de tableau (base de données).
     *
     * @param object $destinataire
     * @return array
     */
    public function toArray(object $destinataire): array
    {
        return [
            'studio_id' => $this->studio->id,
            'studio_name' => $this->studio->name,
            'owner_name' => ($this->studio->proprietaire->first_name ?? '') . ' ' . ($this->studio->proprietaire->last_name ?? ''),
            'message' => 'Nouveau studio créé : ' . $this->studio->name,
        ];
    }
}

