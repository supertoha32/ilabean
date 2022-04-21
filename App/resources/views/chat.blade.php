@extends('layouts.basic-layout')

@section('content')
    @php
        $user = \Illuminate\Support\Facades\Auth::user();
        $messages = \App\Models\Message::query()->where('from_id', $user->id)->orWhere('to_id', $user->id)->get();
        $seenChats = array();
        $unseenChats = array();
        foreach ($messages as $message) {
            $rec = 0;
            if($message->from_id == $user->id) {
                $rec = $message->to_id;
            }
            if($message->to_id == $user->id) {
                $rec = $message->from_id;
            }
            $seenChats[$message->item_id] = $rec;
            if(!$message->seen) {
                $unseenChats[$message->item_id] = $rec;
            }
        }
        foreach(array_keys($unseenChats) as $key) {
            unset($seenChats[$key]);
        }
    @endphp

    <div class="flex h-96 my-5">
        <div class="bg-gray-100 w-1/3 h-full rounded-l-md shadow overflow-auto max-h-full">
            <div class="p-2 mb-2 font-semibold">Доступные чаты</div>
            <div class="flex flex-col">
                @foreach(array_keys($unseenChats) as $key)
                    <a href="{{\Illuminate\Support\Facades\URL::to('/chats/'.$key)}}"
                       class="border-t border-b border-t-600 border-b-600 p-2">
                        @php
                            $desc = \App\Models\Item::find($key)->description;
                            $desc = mb_substr($desc, 0, 17) . '...';
                        @endphp
                        <div class="font-semibold">{{$desc}}</div>
                        <div class="font-light text-sm text-gray-500">
                            Кому: {{\App\Models\User::find(intval($unseenChats[$key]))->name}}</div>
                    </a>
                @endforeach
                @foreach(array_keys($seenChats) as $key)
                    <a href="{{\Illuminate\Support\Facades\URL::to('/chats/'.$key)}}"
                       class="border-t border-b border-t-600 border-b-600 p-2">
                        @php
                            $desc = \App\Models\Item::find($key)->description;
                            $desc = mb_substr($desc, 0, 17) . '...';
                        @endphp
                        <div class="">{{$desc}}</div>
                        <div class="font-light text-sm text-gray-500">
                            Кому: {{\App\Models\User::find(intval($seenChats[$key]))->name}}</div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="p-3 bg-gray-100 w-2/3 rounded-r-md shadow flex flex-col justify-between">
            <div class="overflow-auto overscroll-y-auto h-5/6" id="messages">
                @if(isset($chat))
                    @php($rec = \App\Models\Item::findOrFail($chat)->user_id)
                    @php($user = \Illuminate\Support\Facades\Auth::user()->id)
                    @php( $msg = \App\Models\Message::query()->where('item_id', $chat)->where(function($query) use($user){
                            $query->where('from_id', $user)->orWhere('to_id', $user);
                        })->get())
                    @php($last = null)
                    @foreach($msg as $message)
                        @php($rec = $message->from_id)

                        @if($message->type == null)
                            @php($message->seen = true)
                            @php($message->update())

                            @if($message->from_id == $user)
                                <div
                                    class="@if($message->seen)bg-blue-100 @else bg-blue-400 text-gray-50 @endif ml-auto w-fit p-2 mb-2 rounded-xl">
                                    <span>{{$message->body}}</span>
                                    @php($last = 'from')
                                </div>
                            @endif

                            @if($message->to_id == $user)
                                <div class="bg-gray-200 w-fit p-2 mb-2 rounded-xl">
                                    @unless($last == 'to')
                                        <div class="text-gray-500 text-sm">
                                            {{\App\Models\User::find($message->from_id)->name}}</div>
                                    @endunless
                                    <span>{{$message->body}}</span>
                                    @php($last = 'to')
                                </div>
                            @endif
                        @else
                            @php($message->seen = true)
                            @php($message->update())
                            @if($message->type == 'REQUEST')
                                <div class="my-2">
                                    Пользователь оставил заявку
                                </div>
                            @endif
                            @if($message->type == 'APPROVE')
                                <div class="my-2">
                                    Создатель объявления одобрил заявку
                                </div>
                            @endif
                            @if($message->type == 'DISAPPROVE')
                                <div class="my-2">
                                    Создатель объявления отклонил вашу заявку
                                </div>
                            @endif
                        @endif
                    @endforeach
                @else
                    <div class="text-gray-600">
                        Диалог не открыт...
                    </div>
                @endif
            </div>
            @if(isset($chat))
                <div class="flex">
                    @php($item = \App\Models\Item::find($chat))
                    @if($item->status != "NOT_RELEVANT" && auth()->id() == $item->user_id)
                        <form action="{{url()->current().'/approve'}}" method="POST">
                            @csrf
                            <input class="hidden" name="to_id" value="{{$rec}}">
                            <button class="bg-blue-500 hover:bg-blue-600 text-gray-50 py-2 px-4 rounded-xl mr-3"
                                    type="submit">Одобрить
                            </button>
                        </form>
                    @endif
                    <form class="flex w-full">
                        <input id="message" name="body" class="flex-auto border-gray-300 rounded-xl w-full mr-3"
                               type="text">
                        <button onclick="send()" class="text-gray-50 bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-xl"
                                type="submit">
                            Отправить
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <script>
        document.onreadystatechange = scroll()

        function scroll() {
            const el = document.getElementById('messages')
            el.scrollTo(0, el.scrollHeight)
        }

        @if(isset($chat))
        function send() {
            axios.post('{{\Illuminate\Support\Facades\URL::current().'/send'}}', {
                to_id: {{$rec}},
                from_id: {{\Illuminate\Support\Facades\Auth::user()->id}},
                key: '{{\Illuminate\Support\Facades\Auth::user()->getAuthPassword()}}',
                body: document.getElementById('message').value,
            })
        }

        window.Echo.channel('{{'chat-'.$chat.'-'.$rec.'-'.\Illuminate\Support\Facades\Auth::id()}}').listen('.messageEvent', (e) => {
            document.getElementById('messages').innerHTML += '' +
                '<div class="bg-gray-200 w-fit p-2 mb-2 rounded-xl">' +
                '<div class="text-gray-500 text-sm">' +
                '{{\App\Models\Item::find($chat)->user->name}}' +
                '</div>' +
                '<span>' + e.body + '</span>' +
                '</div>'
            scroll()
        })
        @endif
    </script>
@endsection
