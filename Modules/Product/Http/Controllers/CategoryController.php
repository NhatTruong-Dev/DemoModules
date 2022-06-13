<?php

namespace Modules\Product\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories =Category::all();
        return view('product::category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('product::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:category|max:255',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục !',
            'name.unique' => 'Đã tồn tại tên danh mục ! Vui lòng nhập tên khác',
        ]);


        $data = Category::create($validated);

        Toastr::success('Thêm danh mục thành công');
        return redirect()->route('category.index',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $category = Category::find($id);
        return view('product::category.show')->with('categories', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = Category::find($id);
        return view('product::category.edit')->with('categories', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $validated = $request->validate([
            'name' => 'required|unique:category|max:255',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục !',
            'name.unique' => 'Đã tồn tại tên danh mục ! Vui lòng nhập tên khác',
        ]);


        $category->update($validated);
        Toastr::success('Sửa danh mục thành công');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Category::destroy($id);
        Toastr::success('Xóa danh mục thành công');
        return redirect()->route('category.index');
    }
}
