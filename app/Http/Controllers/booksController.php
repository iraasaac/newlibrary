<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Session;

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




    // users functions
    public function users()
    {
        return User::get();
    }
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
    public function login(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'User login successfully';
        } 
        else {
            $success = false;
            $message = 'Invalid credentials';
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
    public function deleteuser($id)
    {
        $usertodelete = User::find($id);
        if ($usertodelete) {
            $usertodelete->delete();
            return response()->json('success');
        }
        return 'Not found';
    }
    public function edituser($id)
    {
        $book = User::find($id);
        return response()->json($book);
    }
    public function updateuser(Request $request, $id)
    {
        $usertoupdate = User::find($id);
        if ($usertoupdate) {
            $usertoupdate->name = $request->input('name');
            $usertoupdate->email = $request->input('email');
            $usertoupdate->password = Hash::make($request->password);
            $usertoupdate->save();
            return $usertoupdate;
        }
        return 'Not found';
    }

    // Counting
    public function getbooksinfo()
    {
        $allbooks = books::get();
        $totalallbooks = $allbooks->count();
        $availablebooks = books::where('book_availability', '==', 1)->get();
        $totalavailablebooks = $availablebooks->count();
        $unavailablebooks = books::where('book_availability', '==', 0)->get();
        $totalunavailablebooks = $unavailablebooks->count();
        $response = [
            'success' => true,
            'allbooks' => $totalallbooks,
            'available' => $totalavailablebooks,
            'unavailable' => $totalunavailablebooks,
        ];
        return response()->json($response);
    }
    public function getusersnumber()
    {
        $allusers = User::get();
        $totalallusers = $allusers->count();
        $response = [
            'success' => true,
            'users' => $totalallusers
        ];
        return response()->json($response);
    }

}
