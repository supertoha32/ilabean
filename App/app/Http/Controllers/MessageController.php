<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Item;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use function PHPUnit\Framework\at;

class MessageController extends Controller
{
    public function getChats()
    {
        return view('chat');
    }

    public function getChat($id)
    {
        return view('chat', ['chat' => $id]);
    }

    public function sendMessage($id)
    {
        $attributes = \request()->validate([
            'body' => ['required', 'string', 'min:1', 'max:5000'],
            'to_id' => ['required', 'integer', 'exists:users,id'],
            'from_id' => ['required', 'integer', 'exists:users,id'],
            'key' => ['required'],
        ]);

        if (User::find($attributes['from_id'])->password != $attributes['key'])
            return ['success' => false];

        $attributes['item_id'] = $id;
        Message::create($attributes);

        event(new MessageEvent($attributes['from_id'], $attributes['to_id'], $id, $attributes['body']));

        return ['success' => true];
    }

    public function sendRequest($id)
    {
        $item = Item::findOrFail($id);
        $from_id = Auth::id();
        $to_id = $item->user_id;
        if(request()->get('body') != null) {
            Message::create([
                'item_id' => $item->id,
                'from_id' => $from_id,
                'to_id' => $to_id,
                'body' => request()->get('body'),
            ]);
        }
        Message::create([
            'item_id' => $item->id,
            'from_id' => $from_id,
            'to_id' => $to_id,
            'type' => 'REQUEST',
            'body' => ''
        ]);
        return redirect(URL::to('chats/' . $id));
    }

    public function approveRequest($id)
    {
        $item = Item::findOrFail($id);
        if (\auth()->id() == $item->user_id) {
            Message::create([
                'item_id' => $id,
                'from_id' => \auth()->id(),
                'to_id' => \request()->get('to_id'),
                'type' => 'APPROVE',
                'body' => ''
            ]);
        }

        $item->status = 'NOT_RELEVANT';
        $item->update();

        return redirect(URL::to('chats/' . $id));
    }
}
