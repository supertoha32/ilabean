@extends('layouts.basic-layout')

@section('content')
    <div
        class="left-0 absolute bg-gradient-to-br from-blue-700 via-purple-500 to-purple-500 w-screen h-4/5 bg-cover bg-center"></div>
    <div class="w-full h-screen relative">
        <div class="absolute">
            <div class="my-10 text-gray-50 text-5xl">Лабеан</div>
            <div class="text-gray-50 text-4xl">торговая площадка для <br> промышленных предприятий</div>
            <a class="text-gray-50 border border-gray-50 w-fit p-3 relative top-12 rounded-xl hover:bg-white hover:text-blue-600"
               href="#work">Подробнее</a>
        </div>
    </div>
    <div class="ml-auto w-1/2">
        <div class="text-3xl mb-10">Для поставщика</div>
        <p class="break-words mb-5">Ознакомьтесь с уже созданными запросами на покупку товара или создавайте объявление
            об оптовой продаже товара. Выберите категорию товара из
            предложенного списка. Добавьте описание продаваемой продукции. Установите цену оптовой продажи и
            валюту, в которой желаете продавать товар. Введите количество имеющегося товара. Впишите город, в
            котором вы продаете свою продукцию.</p>
        <a href="{{\Illuminate\Support\Facades\URL::to("/sell")}}"
           class="py-2 px-4 bg-blue-500 hover:bg-blue-600 w-fit text-gray-50 rounded-xl">Стать поставщиком</a>
    </div>
    <div class="my-16 w-1/2">
        <div class="text-3xl mb-10">Для заказчика</div>
        <p class="break-words mb-5">Ознакомьтесь с ассортиментов продукции, предоставленной предприятиями или создайте
            объявление об оптовой закупке товара. Выберите категорию покупаемой
            продукции из
            предложенного списка. Добавьте описание для поставщиков. Установите цену оптовой покупки и
            валюту, в которой желаете покупать товар. Введите необходимое количество товара. Впишите город, в
            котором находится ваше предприятие.</p>
        <a href="{{\Illuminate\Support\Facades\URL::to("/buy")}}"
           class="py-2 px-4 bg-blue-500 hover:bg-blue-600 w-fit text-gray-50 rounded-xl">Стать поставщиком</a>
    </div>
    <div class="text-3xl"><a name="work">О платформе</a></div>
    <div class="">
        <p class="break-words my-10 text-gray-600">
            Торговая площадка Лабеан – это не просто место для обмена товарами, а бесконечный край возможностей и
            перспектив для предпринимателей и закупщиков. Наша организация позволяет свободно распоряжаться своими
            товарами и ценами на них, при это предоставляет для покупателей возможность выбора наиболее выгодных и
            полезных решений. Если Вы пожелаете стать поставщиком, Лабеан позволит Вам определить
            категорию своего товара, установить цену и количество вашей продукции при выставлении на продажу.
            Если же Вы желаете стать закупщиком на нашей торговой площадке, то вы можете найти необходимый товар,
            используя фильтры и поиск.
        </p>
    </div>
    <div class="w-1/2 ml-auto">
        <div class="text-3xl">В чем преимущества площадки?</div>
        <ul class="my-10 text-gray-600">
            <li>Простая и быстрая регистрация</li>
            <li>Интуитивно понятный интерфейс без лишних полей</li>
            <li>Настраиваемые условия сделки</li>
            <li>Возможность общения поставщика и заказчика в чате</li>
        </ul>
        <a href="{{\Illuminate\Support\Facades\URL::to("/register")}}"
           class="py-2 px-4 bg-blue-500 hover:bg-blue-600 w-fit text-gray-50 rounded-xl">Зарегистрироваться</a>
    </div>
    <div class="text-3xl mt-16 mb-5">Остались вопросы?</div>
    <div class="mb-16">Обратитесь в поддержку или напишите нам на почту <span class="font-semibold">nepridumalipochtu@labean.ru</span>,
        чтобы узнать
        ответы на любые вопросы.
    </div>
@endsection
