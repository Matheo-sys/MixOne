<?php

namespace App\Http\Controllers;

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
    public function __construct(
        private readonly SendMessageAction $sendMessageAction
    ) {}

    public function store(SendMessageRequest $request): JsonResponse
    {
        $dto = $request->toDTO();
        $this->sendMessageAction->execute($dto);

        // Unhide conversation if a new message is sent
        HiddenConversation::where(function($query) use ($dto) {
            $query->where('user_id', Auth::id())->where('contact_id', $dto->receiverId);
        })->orWhere(function($query) use ($dto) {
            $query->where('user_id', $dto->receiverId)->where('contact_id', Auth::id());
        })->delete();

        return response()->json(['success' => 'Message sent successfully.']);
    }

    public function update(Request $request, Message $message): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|min:1|max:2000',
        ]);

        if ($message->sender_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($message->created_at->diffInMinutes(now()) > 10) {
            return response()->json(['error' => 'Ce message ne peut plus être modifié (délai de 10 minutes dépassé).'], 403);
        }

        $message->update([
            'message' => $request->input('message'),
            'is_edited' => true
        ]);

        return response()->json(['success' => 'Message updated successfully.']);
    }

    public function index(): JsonResponse
    {
        $messages = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender:id,first_name,last_name,avatar', 'receiver:id,first_name,last_name,avatar'])
            ->orderBy('created_at', 'asc')
            ->get();

        $hiddenContacts = HiddenConversation::where('user_id', Auth::id())
            ->pluck('contact_id');

        return response()->json([
            'messages' => $messages,
            'hidden_contacts' => $hiddenContacts
        ]);
    }

    public function searchUsers(Request $request): JsonResponse
    {
        $request->validate([
            'q' => 'nullable|string|max:100',
        ]);

        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        $users = User::where('id', '!=', Auth::id())
            ->where(function($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get(['id', 'first_name', 'last_name', 'avatar']);

        return response()->json($users);
    }

    public function hideConversation(int $contactId): JsonResponse
    {
        // Valider que le contact existe
        if (!User::where('id', $contactId)->exists()) {
            return response()->json(['error' => 'Contact introuvable.'], 404);
        }

        HiddenConversation::firstOrCreate([
            'user_id' => Auth::id(),
            'contact_id' => $contactId
        ]);

        return response()->json(['success' => true]);
    }

    public function getUnreadCount(): JsonResponse
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function markAsRead(Request $request): JsonResponse
    {
        $request->validate([
            'sender_id' => 'nullable|integer|exists:users,id',
        ]);

        $senderId = $request->input('sender_id');

        $query = Message::where('receiver_id', Auth::id())
            ->where('is_read', false);

        if ($senderId) {
            $query->where('sender_id', $senderId);
        }

        $query->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
