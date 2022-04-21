<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    public function filter($i, $type)
    {
        $sort = session()->get('sort');
        $category = session()->get('category');
        $currency = session()->get('currency');
        $keywords = session()->get('keywords');

        $i = $i->whereNot('status', 'NOT_RELEVANT');

        if ($sort == null) return $i->orderBy('id', 'desc');

        $i = $i->where(function ($items) use ($currency, $category, $sort, $type, $keywords) {
            if ($keywords != null) {
                $items = $items->where('id', '-1');
                foreach (explode(' ', $keywords) as $keyword) {
                    $items = $items->orWhere(function ($query) use ($keyword, $type) {
                        $query->where('type', $type)->where('description', 'like', '%' . $keyword . '%');
                    });
                    $items = $items->orWhere(function ($query) use ($keyword, $type) {
                        $query->where('type', $type)->where('city', 'like', '%' . $keyword . '%');
                    });
                }
            }

            switch ($sort) {
                case 'later':
                    $items = $items->orderBy('id', 'desc');
                    break;
                case 'earlier':
                    $items = $items->orderBy('id', 'asc');
                    break;
                case 'more':
                    $items = $items->orderBy('amount', 'desc');
                    break;
                case 'less':
                    $items = $items->orderBy('amount', 'asc');
                    break;
            }

            if ($category != 'default') {
                $items = $items->where('category_id', $category);
            }

            if ($currency != 'any') {
                switch ($currency) {
                    case "RUB":
                        $items = $items->where('currency', 'RUB');
                        break;
                    case "USD":
                        $items = $items->where('currency', 'USD');
                        break;
                    case "CNY":
                        $items = $items->where('currency', 'CNY');
                        break;
                }
            }
            return $items;
        });

        session()->remove('sort');
        session()->remove('category');
        session()->remove('currency');
        session()->remove('keywords');

        return $i;
    }

    public function getBuyItems()
    {
        $items = Item::with('category', 'user')->where('type', 'buy');
        $items = $this->filter($items, 'buy');
        return view('sell', ['items' => $items->get()]);
    }

    public function getSellItems()
    {
        $items = Item::with('category', 'user')->where('type', 'sell');
        $items = $this->filter($items, 'sell');
        return view('buy', ['items' => $items->get()]);
    }

    public function openRequestSell($id)
    {
        return view('requestsell', ['item' => Item::findOrFail($id)]);
    }

    public function openRequestBuy($id)
    {
        return view('requestbuy', ['item' => Item::findOrFail($id)]);
    }

    public function storeBuy()
    {
        $attributes = request()->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'description' => ['required', 'string', 'min:10', 'max:1024'],
            'price' => ['required'],
            'currency' => ['required', 'string'],
            'amount' => ['required', 'integer'],
            'city' => ['required', 'string', 'max:32'],
            'file.*' => ['nullable', 'mimes:jpg,jpeg,png,bmp,gif,svg,docx,xlsx,pdf'],
        ]);
        $attributes['type'] = 'buy';
        $attributes['user_id'] = Auth::id();

        if(request()->hasFile('file')){
            $image = request()->file('file');
            $data = [];
            foreach ($image as $img) {
                $new_name = rand() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('uploads'), $new_name);
                $data[] = $new_name;

                $attributes['files'] = json_encode($data);
            }
        }

        Item::create($attributes);

        return redirect('/sell')->with('success', 'Вы успешно добавили запрос');
    }

    public function storeSell()
    {
        $attributes = request()->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'description' => ['required', 'string', 'min:10', 'max:1024'],
            'price' => ['required'],
            'currency' => ['required', 'string'],
            'amount' => ['required', 'integer'],
            'city' => ['required', 'string', 'max:32'],
            'file.*' => ['nullable', 'mimes:jpg,jpeg,png,bmp,gif,svg,docx,xlsx,pdf'],
        ]);
        $attributes['type'] = 'sell';
        $attributes['user_id'] = Auth::id();

        if(request()->hasFile('file')){
            $image = request()->file('file');
            $data = [];
            foreach ($image as $img) {
                $new_name = rand() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('uploads'), $new_name);
                $data[] = $new_name;

                $attributes['files'] = json_encode($data);
            }
        }

        Item::create($attributes);

        return redirect('/buy')->with('success', 'Вы успешно добавили запрос');
    }

    public function setFilters()
    {
        session()->start();
        session()->flash('sort', request()->get('sort'));
        session()->flash('category', request()->get('category'));
        session()->flash('currency', request()->get('currency'));
        session()->flash('keywords', request()->get('keywords'));
        return redirect()->back();
    }

    public function openRedactSell($id)
    {
        $item = Item::findOrFail($id);
        if ($item->user->id != Auth::id() || $item->type == 'sell') abort(403);
        return view('sellredact', ['item' => $item]);
    }

    public function openRedactBuy($id)
    {
        $item = Item::findOrFail($id);
        if ($item->user->id != Auth::id() || $item->type == 'buy') abort(403);
        return view('buyredact', ['item' => $item]);
    }

    public function redactBuy($id)
    {
        $item = Item::findOrFail($id);
        if ($item->user->id != Auth::id() || $item->type == 'buy') abort(403);

        $attributes = request()->validate([
            'description' => ['required', 'string', 'min:10', 'max:1024'],
            'price' => ['required'],
            'currency' => ['required', 'string'],
            'amount' => ['required', 'integer'],
            'city' => ['required', 'string', 'max:32'],
        ]);

        $item = Item::findOrFail($id);

        $item->description = $attributes['description'];
        $item->price = $attributes['price'];
        $item->currency = $attributes['currency'];
        $item->amount = $attributes['amount'];
        $item->city = $attributes['city'];

        $item->update();
        return redirect('/')->with('success', 'Вы успешно отредактировали запрос');
    }

    public function redactSell($id)
    {
        $item = Item::findOrFail($id);
        if ($item->user->id != Auth::id() || $item->type == 'buy') abort(403);

        $attributes = request()->validate([
            'description' => ['required', 'string', 'min:10', 'max:1024'],
            'price' => ['required'],
            'currency' => ['required', 'string'],
            'amount' => ['required', 'integer'],
            'city' => ['required', 'string', 'max:32'],
        ]);

        $item = Item::findOrFail($id);

        $item->description = $attributes['description'];
        $item->price = $attributes['price'];
        $item->currency = $attributes['currency'];
        $item->amount = $attributes['amount'];
        $item->city = $attributes['city'];

        $item->update();

        return redirect('/')->with('success', 'Вы успешно отредактировали запрос');
    }

    public function redactSellDelete($id)
    {
        $item = Item::findOrFail($id);
        if ($item->user->id != Auth::id() || $item->type == 'buy') abort(403);

        $item->status = 'NOT_RELEVANT';
        $item->update();
        return redirect('/')->with('success', 'Вы успешно удалили запрос');
    }

    public function redactBuyDelete($id)
    {
        $item = Item::findOrFail($id);
        if ($item->user->id != Auth::id() || $item->type == 'sell') abort(403);

        $item->status = 'NOT_RELEVANT';
        $item->update();
        return redirect('/')->with('success', 'Вы успешно удалили запрос');
    }
}
