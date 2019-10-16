<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
    public function drivers()
    {
        return view('pages.drivers');
    }
    public function driver($id)
    {
        return view('pages.driver', ['id' => $id]);
    }
    public function routes()
    {
        return view('pages.routes');
    }
    public function route($id)
    {
        return view('pages.route', ['id' => $id]);
    }
}
