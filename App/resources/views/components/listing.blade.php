<div class="w-full my-10">
    <div class="flex">
        <form action="{{URL::to('/filters')}}" method="POST" class="flex flex-wrap">

            @csrf

            <select onchange="" name="sort" id="sort"
                    class="w-36 mr-5 mb-3 cursor-pointer rounded-full bg-gray-200 px-3 py-1.5 text-xs text-grey-800">
                <option value="later" class="bg-white">Последние</option>
                <option value="earlier" class="bg-white">Ранние</option>
                <option value="more" class="bg-white">Больше товаров</option>
                <option value="less" class="bg-white">Меньше товаров</option>
            </select>
            <select onchange="" name="category" id="category"
                    class="w-36 mr-5 mb-3 cursor-pointer rounded-full bg-gray-200 px-3 py-1.5 text-xs text-grey-800">
                <option value="default" class="bg-white">Любая категория</option>
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{$category->id}}" class="bg-white">{{$category->name}}</option>
                @endforeach
            </select>
            <select onchange="" name="currency" id="currency"
                    class="w-36 mr-5 mb-3 cursor-pointer rounded-full bg-gray-200 px-3 py-1.5 text-xs text-grey-800">
                <option value="any" class="bg-white">Любая валюта</option>
                <option value="RUB">RUB (₽)</option>
                <option value="USD">USD ($)</option>
                <option value="CNY">CNY (¥)
            </select>
            <div class="">
                <label for="keywords" class="mr-2">Ключевые слова:</label>
                <input placeholder="Велосипед..." type="text" name="keywords" id="keywords"
                       class="w-36 mr-5 mb-3 cursor-pointer rounded-full bg-gray-200 px-3 py-1.5 text-xs text-grey-800">
            </div>
            <button type="submit" class="text-gray-50 bg-blue-500 hover:bg-blue-600 rounded-xl py-1 px-4 h-fit">Поиск
            </button>
        </form>
    </div>
</div>
<div class="flex flex-wrap">
    @if($items->isEmpty())
        <div class="text-gray-800 text-xl">Товаров не найдено...</div>
    @endif
    @foreach($items as $item)
        <x-item :item="$item"/>
    @endforeach
</div>
