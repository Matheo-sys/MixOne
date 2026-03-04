<?php

namespace App\Http\Controllers;

use App\Actions\Messaging\SendMessageAction;
use App\Http\Requests\Messaging\SendMessageRequest;
use App\Models\Message;
use App\Models\HiddenConversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    public function __construct(
        private SendMessageAction $sendMessageAction
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

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|min:1|max:2000',
        ]);

        $message = Message::findOrFail($id);

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
            ->with(['sender', 'receiver'])
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
        $query = $request->get('q');
        $users = \App\Models\User::where('id', '!=', Auth::id())
            ->where(function($q) use ($query) {
                $q->where('first_name', 'like', "%$query%")
                  ->orWhere('last_name', 'like', "%$query%");
            })
            ->limit(10)
            ->get(['id', 'first_name', 'last_name', 'avatar']);

        return response()->json($users);
    }

    public function hideConversation(Request $request, $contactId): JsonResponse
    {
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
        $senderId = $request->input('sender_id');

        if ($senderId) {
            Message::where('receiver_id', Auth::id())
                ->where('sender_id', $senderId)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        } else {
            // Option to mark all as read if needed
            Message::where('receiver_id', Auth::id())
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }
}
