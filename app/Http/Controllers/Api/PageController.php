<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\http\Helpers\ApiResponse;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'book_id' => "required|exists:books,id",
        ]);
        if($validated->fails()){
            return ApiResponse::validatorFail($validated);
        }
        $pages = Book::with(["pages" => function($q){
            $q->orderBy("page_no","asc");
        }])->find($request->book_id);
        return ApiResponse::success('Pages found',200,$pages);
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

        $validated = Validator::make($request->all(),[
            "name" => "required|max:191",
            "book_id" => "required|exists:books,id",
        ]);
        if($validated->fails()){
            return ApiResponse::validatorFail($validated);
        }

        try{
            $book = Book::find($request->book_id);
            $book->pages()->create([
                'name' => $request->name,
            ]);

            return ApiResponse::success("Page created successfully!",200,$book);
        }catch(\Exception $e){
            return ApiResponse::fail("Exception",500,$e->getMessage());
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        return ApiResponse::success('Page found',200,$page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(),[
            "name" => "required|max:191"
        ]);
        if($validated->fails()){
            return ApiResponse::validatorFail($validated);
        }

        try{
            Page::findOrFail($id)->update(['name' => $request->name]);
            $page = Page::findOrFail($id);
            return ApiResponse::success("Page updated successfully!",200,$page);
        }catch(\Exception $e){
            return ApiResponse::fail("Exception",500,$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id)->delete();
        return ApiResponse::success('Page Deleted',204,$page);
    }
}
