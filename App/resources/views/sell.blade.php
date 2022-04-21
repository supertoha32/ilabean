@extends('layouts.basic-layout')

@section('content')
    <div class="my-5 text-gray-500">
    <a href="{{\Illuminate\Support\Facades\URL::to('/')}}">Главная</a>
    >
    <a class="text-gray-900">Поставщику</a>
    </div>
    <div class="my-5 text-gray-800 font-semibold text-2xl">Поставщику</div>
    <div class="mt-5">
        В этом разделе предприниматели, заинтересованные в покупке определенного товара, могут оставить свою заявку на
        его закупку в нужном им количестве по фиксированной цене закупки.
        <div class="mt-7">
            <a class="cursor-hover py-2 px-4 rounded-xl bg-blue-500 hover:bg-blue-600 text-gray-50 w-fit"
               href="{{\Illuminate\Support\Facades\URL::to('/sell/new')}}">Стать заказчиком</a>
        </div>
    </div>
    <x-listing :items="$items"/>
@endsection
