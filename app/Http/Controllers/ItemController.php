<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'co2_value' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Item::create([
            'name' => $request->input('name'),
            'co2_value' => $request->input('co2_value'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'co2_value' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item = Item::findOrFail($id);
        $item->update([
            'name' => $request->input('name'),
            'co2_value' => $request->input('co2_value'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
