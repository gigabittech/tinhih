<?php

namespace App\Http\Controllers\Communication;

use App\Http\Controllers\Controller;
use App\Models\Communication\Chat;
use App\Events\ChatMessage;
use App\Models\Admin\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        if (Appointment::findOrFail($request->id)) {
            return view('admin.pages.chats.index');
        }
        // Display the chat interface here
    }

    public function send(Request $request)
    {

        // return response()->json(['message' => $request->all()]);

        $user = Auth::user(); // Get the authenticated user
        $recipientId = $request->receiver_id;
        $appointmentId = $request->appointment_id;
        $messageText = $request->text;
        //        return response()->json(['message' => $recipientId]);
        // Create a chat message in the database
        $chat = new Chat([
            'user_id' => $user->id,
            'sender_id' => $user->id,
            'receiver_id' => $recipientId,
            'appointment_id' => $appointmentId,
            'message' => $messageText,
        ]);

        $chat->save();

        $chatWithUser = $chat->toArray(); // Convert $chat to an array
        $chatWithUser['user'] = $chat->user->toArray(); // Convert user to an array


        event(new ChatMessage($chatWithUser));

        // Broadcast the message to the recipient using Laravel WebSockets
//        broadcast(new ChatMessage($chat))->toOthers();

        return response()->json(['message' => 'Message sent']);
    }
    public function getMessage(Request $request)
    {
        $messages = Chat::with('sender', 'receiver', 'user')
            ->where('appointment_id', $request->id)->get();

        return response()->json(['messages' => $messages]);
        ;

    }
}
