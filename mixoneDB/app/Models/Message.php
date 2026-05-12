<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
        'is_edited',
    ];

    /**
     * Relation avec l'expéditeur du message.
     */
    public function expediteur()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relation avec le destinataire du message.
     */
    public function destinataire()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Alias anglais pour le JS (msg.sender / msg.receiver).
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}


