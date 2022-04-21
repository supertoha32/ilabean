@extends('layouts.basic-layout')

@section('content')
    <div class="my-5 text-gray-800 font-semibold text-2xl">Личный кабинет</div>
    <div class="flex flex-col">
        <div class="text-gray-500 my-2 flex justify-between">
            <div class="">Заявки на покупку</div>
            <a href="{{\Illuminate\Support\Facades\URL::to("/sell/new")}}"
               class="hover:bg-blue-600 rounded-full text-gray-50 font-black bg-blue-500 px-1.5 pb-0.5">+</a>
        </div>
        @php($buyitems = \App\Models\Item::with('user', 'category')
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('type', 'buy')
            ->whereNot('status', 'NOT_RELEVANT')->get())
        @if($buyitems->isEmpty())
            <span class="text-gray-500 mb-5">
                Не создано ни одного запроса...
                <a href="{{\Illuminate\Support\Facades\URL::to("/sell/new")}}" class="text-blue-500">Создать?</a>
            </span>
        @endif
        @foreach($buyitems as $item)
            <div class="mb-2 p-2 rounded-md flex justify-between bg-gray-100 h-fit w-full">
                <div class="w-1/12 font-semibold">id-{{$item->id}}</div>
                @php($url = URL::to('sell/view/'.$item->id))
                <div class="w-1/2 text-blue-500"><a href="{{$url}}">{{$url}}</a></div>
                <div class="w-1/2">Статус:
                    @switch($item->status)
                        @case('NOT_APPROVED')
                        {{'Не верифицирована'}}
                        @break
                        @case('OK')
                        {{'Покупка происходит'}}
                    @endswitch
                </div>
                <div class="w-fit uppercase text-blue-500 font-semibold">
                    <a href="{{$url.'/redact'}}">Редактировать</a>
                </div>
            </div>
        @endforeach
        <div class="text-gray-500 my-2 flex justify-between">
            <div class="">Заявки на продажу</div>
            <a href="{{\Illuminate\Support\Facades\URL::to("/buy/new")}}"
               class="hover:bg-blue-600 rounded-full text-gray-50 font-black bg-blue-500 px-1.5 pb-0.5">+</a>
        </div>
        @php($sellitems = \App\Models\Item::with('user', 'category')
                ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->where('type', 'sell')
                ->whereNot('status', 'NOT_RELEVANT')->get())
        @if($sellitems->isEmpty())
            <span class="text-gray-500 mb-5">
                Не создано ни одного запроса...
                <a href="{{\Illuminate\Support\Facades\URL::to("/buy/new")}}" class="text-blue-500">Создать?</a>
            </span>
        @endif
        @foreach($sellitems as $item)
            <div class="mb-2 p-2 rounded-md flex justify-between bg-gray-100 h-fit w-full">
                <div class="w-1/12 font-semibold">id-{{$item->id}}</div>
                @php($url = URL::to('buy/view/'.$item->id))
                <div class="w-1/2 text-blue-500"><a href="{{$url}}">{{$url}}</a></div>
                <div class="w-1/2">Статус:
                    @switch($item->status)
                        @case('NOT_APPROVED')
                        {{'Не верифицирована'}}
                        @break
                        @case('OK')
                        {{'Покупка происходит'}}
                    @endswitch
                </div>
                <div class="w-fit uppercase text-blue-500 font-semibold">
                    <a href="{{$url.'/redact'}}">Редактировать</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
