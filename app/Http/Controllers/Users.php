<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//CRUD (CREATE, Read, Update, Destroy) Controller
class Users extends Controller
{

	public function login_get()
	{
		return view('login');
	}

	public function login_post()
	{
		$remember=\request()->has('remember')?true:false;
		if(auth()->attempt(['email'=>\request('email'),'password'=>\request('password')],$remember))
		{
			return redirect('home ');
		}
		else{
			return back();
		}
	}

//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    //start calling from routing
//    //users/ route
//    public function index()
//    {
//        //
//	    return view('welcome');
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    //users/create
//    public function create()
//    {
//        //
//        return "Create Successfully...";
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    //users/{id}
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    //users/{id}/edit
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    //users/{id}/
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    //users/{id}/
//    public function destroy($id)
//    {
//        //
//    }
}
