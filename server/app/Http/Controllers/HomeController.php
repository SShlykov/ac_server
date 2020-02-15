<?php

namespace App\Http\Controllers;

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
    public function tests()
    {
        return view('pages.tests');
    }
    public function tours()
    {
        return view('pages.tours');
    }
    public function category($id)
    {
        return view('pages.category', ['id' => $id]);
    }

    public function deleteddrivers()
    {
        return view('pages.deleteddrivers');
    }

    public function editrouts()
    {
        return view('pages.editrouts');
    }

    public function settings()
    {
        return view('pages.settings');
    }

    public function editcategories()
    {
        return view('pages.editcategories');
    }

    public function notices()
    {
        return view('pages.notices');
    }
}
