<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function createCategories() {
        Category::create([
            'slug' => 'food',
            'name' => 'Продукты',
        ]);
        Category::create([
            'slug' => 'metals',
            'name' => 'Металлы',
        ]);
        Category::create([
            'slug' => 'building_materials',
            'name' => 'Стройматериалы',
        ]);
        Category::create([
            'slug' => 'clothes',
            'name' => 'Одежда',
        ]);
        Category::create([
            'slug' => 'household_materials',
            'name' => 'Хозтовары',
        ]);
        Category::create([
            'slug' => 'electronics',
            'name' => 'Электроника',
        ]);
        Category::create([
            'slug' => 'chemicals',
            'name' => 'Химикаты',
        ]);
        Category::create([
            'slug' => 'furniture',
            'name' => 'Мебель',
        ]);
        Category::create([
            'slug' => 'service',
            'name' => 'Услуги',
        ]);
        Category::create([
            'slug' => 'others',
            'name' => 'Прочее',
        ]);
    }

    public function run()
    {
        $this->createCategories();

        Item::create([
            'type' => 'sell',
            'category_id' => 1,
            'user_id' => 1,
            'description' => 'Nice ass bro! Хорошая ass бро.',
            'price' => 269.5,
            'currency' => 'USD',
            'amount' => 567,
            'city' => 'Москва',
        ]);

        Item::create([
            'type' => 'sell',
            'category_id' => 1,
            'user_id' => 1,
            'description' => 'Nice ass bro! Хорошая ass бро.',
            'price' => 269.5,
            'currency' => 'USD',
            'amount' => 567,
            'city' => 'Москва',
        ]);

        Item::create([
            'type' => 'sell',
            'category_id' => 1,
            'user_id' => 1,
            'description' => 'Nice ass bro! Хорошая ass бро.',
            'price' => 269.5,
            'currency' => 'USD',
            'amount' => 567,
            'city' => 'Москва',
        ]);

        Item::create([
            'type' => 'sell',
            'category_id' => 1,
            'user_id' => 1,
            'description' => 'Nice ass bro! Хорошая ass бро.',
            'price' => 269.5,
            'currency' => 'USD',
            'amount' => 567,
            'city' => 'Москва',
        ]);

        Item::create([
            'type' => 'sell',
            'category_id' => 1,
            'user_id' => 1,
            'description' => 'Nice ass bro! Хорошая ass бро.',
            'price' => 269.5,
            'currency' => 'USD',
            'amount' => 567,
            'city' => 'Москва',
        ]);

        $user = User::create([
            'name' => 'Олег Петрович Парамонов',
            'number' => "+79054453413",
            'email' => "oleg@petrovich.ru",
            'tin' => '1234567890',
            'password' => '0987654321'
        ]);
    }
}
