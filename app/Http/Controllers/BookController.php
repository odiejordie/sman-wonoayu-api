<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPostRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Throwable;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Book::query();
        $data->when($request->search, function ($q, $search) {
            $q->where("collection_title", "like", "%" . $search . "%");
        });

        return BookResource::collection($data->latest()->get());
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
    public function store(BookPostRequest $request)
    {
        try {
            $data = new Book();
            $data->collection_code = $request->collection_code;
            $data->collection_title = $request->collection_title;
            $data->author = $request->author;
            $data->publisher = $request->publisher;
            $data->stock = $request->stock;
            $data->save();

            return response()->json(
                ["message" => "Successfully created book!"],
                201
            );
        } catch (Throwable $e) {
            report($e);

            return response()->json(
                ["message" => "Something wen't wrong!"],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookPostRequest $request, Book $book)
    {
        try {
            $data = $book;
            $data->collection_title = $request->collection_title;
            $data->author = $request->author;
            $data->publisher = $request->publisher;
            $data->stock = $request->stock;
            $data->save();

            return response()->json(
                ["message" => "Successfully update book!"],
                201
            );
        } catch (Throwable $e) {
            report($e);

            return response()->json(
                ["message" => "Something wen't wrong!"],
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(
            ["message" => "Successfully delete book!"],
            201
        );
    }
}
