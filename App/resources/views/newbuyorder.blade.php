@extends('layouts.basic-layout')

@section('content')
    <div class="text-gray-700 text-2xl font-semibold my-5">Создание запроса на покупку</div>
    <form action="" method="POST" class="flex flex-col" enctype="multipart/form-data">

        @csrf

        <label class="mb-2" for="category_id">Категория покупаемого товара:</label>
        <select class="rounded-md w-fit mb-5" name="category_id" id="">
            @foreach(\App\Models\Category::all() as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>

        <label class="mb-2" for="description">Описание:</label>
        <textarea required class="mb-5 shadow rounded-md w-1/2 min-w-fit h-30 p-1 resize-none text-gray-600"
                  name="description" id=""></textarea>

        <label for="price">Цена закупки (1 шт.):</label>
        <input required class="mb-5 rounded-md w-fit" name="price" type="number">

        <label class="mb-2" for="currency">Валюта:</label>
        <select class="rounded-md w-fit mb-5" name="currency" id="">
            <option value="RUB">RUB (₽)</option>
            <option value="USD">USD ($)</option>
            <option value="CNY">CNY (¥)</option>
        </select>

        <label for="amount">Количество товара:</label>
        <input required class="mb-5 rounded-md w-fit" name="amount" type="number">

        <label for="city">Город:</label>
        <input required class="mb-5 rounded-md w-fit" name="city" type="text">

        <label for="file">Доп. файлы:</label>
        <input class="mb-5" type="file" name="file[]" multiple>

        <button class="mt-5 mb-16 bg-blue-500 hover:bg-blue-600 w-fit py-2 px-4 text-gray-50 rounded-md" type="submit">Создать
            запрос
        </button>
    </form>
@endsection
