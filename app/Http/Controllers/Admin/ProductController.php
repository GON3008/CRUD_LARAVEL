<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';

    public function index()
    {
        $data = Product::query()->with('category')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        $categories = Category::query()
            ->latest()
            ->pluck('name', 'id')
            ->where('is_active', 1)
            ->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'unique:products', 'max:100'],
            'price' => ['numeric', 'digits_between:1,12', 'regex:/^\d+(\.\d{1,2})?$/', 'required'],
            'price_sale' => ['numeric', 'digits_between:1,12', 'regex:/^\d+(\.\d{1,2})?$/', 'nullable'],
            'img' => ['image', 'max:255', 'nullable'],
            'description' => ['nullable', 'max:500'],
            'is_active' => [
                'required',
                Rule::in([
                    Product::Active,
                    Product::IsActive,
                ]),
            ],
        ]);

        $data = \request()->except('img');

        if (\request()->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, \request()->file('img'));
        }

        Product::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    // public function show(Product $product)
    // {
    //     return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    // }

    public function edit(Product $product)
    {
        $categories = Category::query()
            ->latest()
            ->pluck('name', 'id')
            ->where('is_active', 1)
            ->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'max:100', Rule::unique('products')->ignore($product->id)],
            'price' => ['numeric', 'digits_between:1,12', 'regex:/^\d+(\.\d{1,2})?$/', 'required'],
            'price_sale' => ['numeric', 'digits_between:1,12', 'regex:/^\d+(\.\d{1,2})?$/', 'nullable'],
            'img' => ['image', 'max:255', 'nullable', 'required_if:img,null'],
            'description' => ['nullable', 'max:500'],
            'is_active' => [
                'required',
                Rule::in([
                    Product::Active,
                    Product::IsActive,
                ]),
            ],
        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));

            $oldPathImg = $product->img;

            $product->update($data);

            if (Storage::exists($oldPathImg)) {
                Storage::delete($oldPathImg);
            }
        } else {
            $product->update($data);
        }

        return back()->with('msg', 'Thao tác thành công');
    }


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            if (!empty($product->img) && Storage::exists($product->img)) {
                Storage::delete($product->img);
            }

            $product->delete();

            return back()->with('msg', 'Thao tác thành công');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting data: ' . $e->getMessage());
        }
    }




    public function deleteMany()
    {
        //
    }
}