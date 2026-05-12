<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Actions\Messaging\SendMessageAction;
use App\Http\Requests\Messaging\SendMessageRequest;
use App\Models\Message;
use App\Models\HiddenConversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    /**
     * @param SendMessageAction $actionEnvoyerMessage
     */
    public function __construct(
        private readonly SendMessageAction $actionEnvoyerMessage
    ) {}

    /**
     * Enregistrer et envoyer un message.
     *
     * @param SendMessageRequest $requete
     * @return JsonResponse
     */
    public function enregistrer(SendMessageRequest $requete): JsonResponse
    {
        try {
            $dto = $requete->versDTO();
            $this->actionEnvoyerMessage->executer($dto);

            // Réafficher la conversation si un nouveau message est envoyé
            HiddenConversation::where(function($query) use ($dto) {
                $query->where('user_id', Auth::id())->where('contact_id', $dto->id_destinataire);
            })->orWhere(function($query) use ($dto) {
                $query->where('user_id', $dto->id_destinataire)->where('contact_id', Auth::id());
            })->delete();

            return response()->json(['status' => 'success', 'message' => 'Message envoyé avec succès.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Impossible d\'envoyer le message : ' . $e->getMessage()], 422);
        }
    }

    /**
     * Mettre à jour un message existant.
     *
     * @param Request $requete
     * @param Message $message
     * @return JsonResponse
     */
    public function mettreAJour(Request $requete, Message $message): JsonResponse
    {
        $requete->validate([
            'message' => 'required|string|min:1|max:2000',
        ]);

        if ($message->sender_id !== Auth::id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        if ($message->created_at->diffInMinutes(now()) > 10) {
            return response()->json(['error' => 'Ce message ne peut plus être modifié (délai de 10 minutes dépassé).'], 403);
        }

        $message->update([
            'message' => $requete->input('message'),
            'is_edited' => true
        ]);

        return response()->json(['success' => 'Message mis à jour avec succès.']);
    }

    /**
     * Lister les messages de l'utilisateur.
     *
     * @return JsonResponse
     */
    public function afficher(): JsonResponse
    {
        $messages = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender:id,uuid,first_name,last_name,avatar,username,profile,is_admin', 'receiver:id,uuid,first_name,last_name,avatar,username,profile,is_admin'])
            ->orderBy('created_at', 'asc')
            ->get();


        $contactsMasques = HiddenConversation::where('user_id', Auth::id())
            ->pluck('contact_id');

        return response()->json([
            'messages' => $messages,
            'hidden_contacts' => $contactsMasques
        ]);
    }

    /**
     * Rechercher des utilisateurs pour la messagerie.
     * Supporte la recherche par @username, prénom ou nom.
     *
     * @param Request $requete
     * @return JsonResponse
     */
    public function rechercherUtilisateurs(Request $requete): JsonResponse
    {
        $requete->validate([
            'q' => 'nullable|string|max:100',
        ]);

        $recherche = $requete->get('q');

        if (!$recherche) {
            return response()->json([]);
        }

        // Si la recherche commence par @, chercher par username
        $rechercheUsername = ltrim($recherche, '@');

        $utilisateurs = User::where('id', '!=', Auth::id())
            ->where(function($q) use ($recherche, $rechercheUsername) {
                $q->where('username', 'like', "%{$rechercheUsername}%")
                  ->orWhere('first_name', 'like', "%{$recherche}%")
                  ->orWhere('last_name', 'like', "%{$recherche}%");
            })
            ->limit(10)
            ->get(['id', 'uuid', 'first_name', 'last_name', 'avatar', 'username', 'profile', 'is_admin']);

        return response()->json($utilisateurs);
    }

    /**
     * Masquer une conversation.
     *
     * @param int $idContact
     * @return JsonResponse
     */
    public function masquerConversation($idContact): JsonResponse
    {
        // Chercher par ID ou par UUID pour être robuste
        $contact = User::where('id', $idContact)
            ->orWhere('uuid', $idContact)
            ->first();

        if (!$contact) {
            return response()->json(['error' => 'Contact introuvable.'], 404);
        }

        HiddenConversation::firstOrCreate([
            'user_id' => Auth::id(),
            'contact_id' => $contact->id
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Récupérer le nombre de messages non lus.
     *
     * @return JsonResponse
     */
    public function recupererNombreMessagesNonLus(): JsonResponse
    {
        $nombre = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $nombre]);
    }

    /**
     * Marquer les messages comme lus.
     *
     * @param Request $requete
     * @return JsonResponse
     */
    public function marquerCommeLu(Request $requete): JsonResponse
    {
        $requete->validate([
            'sender_id' => 'nullable|integer|exists:users,id',
        ]);

        $idExpediteur = $requete->input('sender_id');

        $requeteMessages = Message::where('receiver_id', Auth::id())
            ->where('is_read', false);

        if ($idExpediteur) {
            $requeteMessages->where('sender_id', $idExpediteur);
        }

        $requeteMessages->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}

