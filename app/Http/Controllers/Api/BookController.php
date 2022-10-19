<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use App\http\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::paginate(15);
        return ApiResponse::success("books fetched successfully!",200,$books);
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
            'book_name' => "required|unique:books,book_name",
            'author_name' => "required",
            'category_id' => 'required|exists:categories,id',
        ]);
        if($validator->fails()){
            return ApiResponse::validatorFail($validator);
        }

        $category = Category::with("books")->findOrFail($request->category_id);
        $category->books()->create([
            'book_name' => $request->book_name,
            'author_name' => $request->author_name,
        ]);
        return ApiResponse::success("Book Created successfully!",200,$category);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
        $validator = Validator::make($request->all(),[
            'book_name' => "required|max:191",
            'author_name' => "required|max:191",
        ]);
        if($validator->fails()){
            return ApiResponse::validatorFail($validator);
        }

        $book->author_name = $request->author_name;
        $book->book_name = $request->book_name;
        $book->save();
        return ApiResponse::success("book updaed successfully!",200,$book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return ApiResponse::success("Book deleted successfully!",200,$book);
    }
}
