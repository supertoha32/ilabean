<div class="w-full sm:w-1/2 lg:w-1/3 p-1">
    <div class="shadow p-3 rounded-xl h-full">
        @php
            $name = $item->description;
            if(strlen($name) > 20) {
                $name = mb_substr($name, 0, 17) . '...';
            }
            $desc = $item->description;
            if(strlen($desc) > 113) {
                $desc = mb_substr($desc, 0, 110) . '...';
            }
        @endphp
        <div class="flex justify-between">
            <b>{{$name}}</b>
            <div class="">{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</div>
        </div>
        @if($item->end_time != null)
            <div class="text-gray-500">Активно до: {{\Carbon\Carbon::parse($item->end_time)->format('d-m-Y')}}</div>
        @endif
        <p class="max-w-full h-fit break-words">{{$desc}}</p>
        <div class="text-gray-500">
            Оптовая цена:
            <span class="text-blue-500">
            {{$item->price}}
                @switch($item->currency)
                    @case("RUB")
                    {{'₽'}}
                    @break
                    @case("USD")
                    {{'$'}}
                    @break
                    @case("CNY")
                    {{'¥'}}
                @endswitch
        </span>
        </div>
        <div class="text-gray-500">
            Количество:
            <span class="text-blue-500">
            {{$item->amount}} шт.
        </span>
        </div>
        <div class="mb-3 text-gray-500">
            Город:
            <span class="text-blue-500">
            {{$item->city}}
        </span>
        </div>
        <a href="{{url()->current()}}/view/{{$item->id}}"
           class="rounded-xl bg-blue-500 hover:bg-blue-600 text-gray-50 flex justify-around py-1.5 px-5 max-w-fit mt-auto">
            Ответить
        </a>
    </div>
</div>
