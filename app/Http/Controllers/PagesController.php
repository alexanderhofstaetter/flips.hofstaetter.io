<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('dashboard')
               ->with('user', Auth::user());
    }

    public function general()
    {
        return view('uni.general')
               ->with('user', Auth::user());
    }

    public function classes()
    {
        return view('uni.classes')
               ->with('user', Auth::user());
    }

    public function grades()
    {
        return view('uni.grades')
               ->with('user', Auth::user());
    }

    public function registration()
    {
        return view('uni.registration')
               ->with('user', Auth::user());
    }

    public function exams()
    {
        return view('uni.exams')
               ->with('user', Auth::user());
    }

    public function news()
    {
        return view('uni.news')
               ->with('user', Auth::user());
    }

    public function download($filename)
    {   
        if ( Storage::exists($filename) )
            return Storage::download($filename);
        return view('dashboard'); 
    }

    /**
     * Show the application settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        return view('settings');
    }
}
