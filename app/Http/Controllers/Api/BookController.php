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
<<<<<<< HEAD
        $books = Book::with(['categories','pages'])->get();
        return ApiResponse::success('Books',200,$books);
=======
        //
        $books = Book::paginate(15);
        return ApiResponse::success("books fetched successfully!",200,$books);
>>>>>>> 6c22a39a9c116daa86fd3d8dbe5e01ead74f8c02
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
<<<<<<< HEAD
        $validated = Validator::make($request->all(),[
            "book_name" => "required|max:191",
            "author_name" => "required|max:191",
        ]);
        if($validated->fails()){
            return ApiResponse::validatorFail($validated);
        }
        try{
            $book = Book::create([
                'book_name' => $request->book_name,
                'author_name' => $request->author_name,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id
            ]);
            return ApiResponse::success('Book Added!',201,$book);
        }
        catch (\Exception $e){
            return ApiResponse::fail("Exception",500,$e->getMessage());
        }
=======
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


>>>>>>> 6c22a39a9c116daa86fd3d8dbe5e01ead74f8c02
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with(['categories','pages'])->findOrFail($id);
        return ApiResponse::success('Book',200,$book);
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
<<<<<<< HEAD
        $validated = Validator::make($request->all(),[
            "book_name" => "required|max:191",
            "author_name" => "required|max:191",
        ]);
        if($validated->fails()){
            return ApiResponse::validatorFail($validated);
        }
        Book::findOrFail($id)->update($request->only(['book_name','author_name']));
        $book = Book::with(['categories','pages'])->findOrFail($id);
        return ApiResponse::success('Book Updated',200,$book);
=======
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
>>>>>>> 6c22a39a9c116daa86fd3d8dbe5e01ead74f8c02
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        Book::findOrFail($id)->delete();
        return ApiResponse::success('Book Deleted',204);
=======
        //
        $book->delete();
        return ApiResponse::success("Book deleted successfully!",200,$book);
>>>>>>> 6c22a39a9c116daa86fd3d8dbe5e01ead74f8c02
    }
}
