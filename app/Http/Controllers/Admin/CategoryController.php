<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    const PATH_VIEW = 'admin.categories.';
   
    public function index()
    {
        $data = Category::query()->latest()->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'unique:categories', 'max:100'],
        ]);


      Category::create(request()->all());

        return back()->with('msg', 'Thao tác thành công');
    }

    public function show(Category $category)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('category'));
    }

    public function edit(Category $category)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        request()->validate([
            'name' => ['required', 'max:100', Rule::unique('categories')->ignore($category->id)],
        ]);

        $category->update(request()->all());

        return back()->with('msg', 'Thao tác thành công');
    }



    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        return back()->with('msg', 'Xoa thanh cong');
    }

}
