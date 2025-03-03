<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
        {
        $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string',
        ]);

        Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
        ]);

    return response()->json(['success' => 'Message sent successfully.']);
    }

    public function index()
    {
        $messages = Message::where('sender_id', Auth::id())
        ->orWhere('receiver_id', Auth::id())
        ->with('sender')
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json($messages);
        }
    }
?>
