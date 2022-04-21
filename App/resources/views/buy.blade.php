@extends('layouts.basic-layout')

@section('content')
    <div class="my-5 text-gray-500">
    <a href="{{\Illuminate\Support\Facades\URL::to('/')}}">Главная</a>
    >
    <a class="text-gray-900">Заказчику</a>
    </div>
    <div class="my-5 text-gray-800 font-semibold text-2xl">Заказчику</div>
    <div class="mе-5">
        В этом разделе предприниматели, заинтересованные в продаже определенного товара, могут создать объявление по
        его продаже в нужных им количествах и по фиксированной оптовой цене.
        <div class="mt-7">
            <a class="cursor-hover py-2 px-4 rounded-xl bg-blue-500 hover:bg-blue-600 text-gray-50 w-fit"
               href="{{\Illuminate\Support\Facades\URL::to('/buy/new')}}">Стать поставщиком</a>
        </div>
    </div>
    <x-listing :items="$items"/>
@endsection
