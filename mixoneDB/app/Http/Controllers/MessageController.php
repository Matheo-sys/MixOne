<?php

namespace App\Http\Controllers;

use App\Actions\Messaging\SendMessageAction;
use App\Http\Requests\Messaging\SendMessageRequest;
use App\Models\Message;
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
        $this->sendMessageAction->execute($request->toDTO());

        return response()->json(['success' => 'Message sent successfully.']);
    }

    public function index(): JsonResponse
    {
        $messages = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
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
}
