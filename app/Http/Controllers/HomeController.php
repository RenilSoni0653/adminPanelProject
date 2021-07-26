<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function blankPage_1()
    {
        $data = \DB::table('demo_test_1')
        ->select('id','text')
        ->get();

        return view('theme.blank_page_1',compact('data'));
    }

    public function blankPage_2()
    {
        return view('theme.blank_page_2');
    }

    public function test(Request $request)
    {
        $data = \DB::table('demo_test_1')
        ->select('id','text')
        ->get();

        return view('theme.blank_page_1',compact('data'));
    }

    public function demo_1(Request $request)
    {
        $id = $request->input('id');
        $demo_Data_1 = \DB::table('demo_test_2')
        ->where('demo_1','=',$id)
        ->select('id','demo_1','text')
        ->get();

        return $demo_Data_1;
    }

    public function demo_2(Request $request)
    {
        $id = $request->input('id');
        $demo_Data_2 = \DB::table('demo_test_3')
        ->where('demo_2','=',$id)
        ->select('id','demo_2','text')
        ->get();

        return $demo_Data_2;
    }
}
