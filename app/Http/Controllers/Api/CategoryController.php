<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use App\http\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return Category::paginate(15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'name' => "required|unique:categories,name",
        ]);
        if($validator->fails()){
            return ApiResponse::validatorFail($validator);
        }

        $category = Category::create([
            'name'  => $request->name,
        ]);

        return ApiResponse::success("Category Created successfully!",200,$category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //

        $validator = Validator::make($request->all(),[
            'name' => "required|unique:categories,name",
        ]);
        if($validator->fails()){
            return ApiResponse::validatorFail($validator);
        }

        $category->name = $request->name;
        $category->save();
        return ApiResponse::success("Category updated successfully!",200,$category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //

        $category->delete();
        return ApiResponse::success("category deleted successfully!",200,$category);
    }
}
