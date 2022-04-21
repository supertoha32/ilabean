@extends('layouts.basic-layout')

@section('content')
    <div class="text-gray-700 text-2xl font-semibold my-5">Запрос номер {{$item->id}}
        <a class="text-blue-500 font-normal" href="{{\Illuminate\Support\Facades\URL::to('/buy/view/'.$item->id)}}">
            ({{\Illuminate\Support\Facades\URL::to('/buy/view/'.$item->id)}})
        </a>
    </div>
    <form action="{{URL::to('buy/view/'.$item->id.'/redact/delete')}}" method="POST">
        @csrf
        <button type="submit" class="py-2 px-4 mb-5 rounded-md text-gray-50 bg-red-500 hover:bg-red-600">Удалить запрос</button>
    </form>
    <form action="" method="POST" class="flex flex-col">

        @csrf

        <label class="mb-2" for="description">Описание:</label>
        <textarea required class="mb-5 shadow rounded-md w-1/2 min-w-fit h-30 p-1 resize-none text-gray-600"
                  name="description" id="">{{$item->description}}</textarea>

        <label for="price">Оптовая цена (1 шт.):</label>
        <input value="{{$item->price}}" required class="mb-5 rounded-md w-fit" name="price" type="number">

        <label class="mb-2" for="currency">Валюта:</label>
        <select class="rounded-md w-fit mb-5" name="currency" id="currency">
            <option value="RUB">RUB (₽)</option>
            <option value="USD">USD ($)</option>
            <option value="CNY">CNY (¥)</option>
        </select>

        <label for="amount">Количество товара:</label>
        <input value="{{$item->amount}}" required class="mb-5 rounded-md w-fit" name="amount" type="number" id="amount">

        <label for="city">Город:</label>
        <input value="{{$item->city}}" required class="mb-5 rounded-md w-fit" name="city" type="text" id="city">

        <button class="mt-5 mb-16 bg-blue-500 hover:bg-blue-600 w-fit py-2 px-4 text-gray-50 rounded-md" type="submit">
            Редактировать
            запрос
        </button>
    </form>
    <script>
        window.onload = function () {
            document.getElementById('currency').value = '{{$item->currency}}'
        }
    </script>
@endsection
