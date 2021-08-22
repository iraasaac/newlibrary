<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;

class booksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return books::orderBy('created_at')->get();
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
        $newbook = new books;
        $newbook->book_code = time();
        $newbook->book_title = $request->input('book_title');
        $newbook->book_author = $request->input('book_author');
        $newbook->save();

        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = books::find($id);
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booktoupdate = books::find($id);
        if ($booktoupdate) {
            $booktoupdate->book_title = $request->input('book_title');
            $booktoupdate->book_author = $request->input('book_author');
            $booktoupdate->book_availability = $request->input('book_availability')?true:false;
            $booktoupdate->save();
            return $booktoupdate;
        }
        return 'Not found';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booktodelete = books::find($id);
        if ($booktodelete) {
            $booktodelete->delete();
            return response()->json('success');
        }
        return 'Not found';
    }
}
