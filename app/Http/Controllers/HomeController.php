<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeModel;

class HomeController extends Controller
{
    private $model;

    public function __construct(HomeModel $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = $this->model->getContacts();

        return view('home', ['contacts' => $contacts]);
    }

    public function addFavorites(Request $request)
    {
        return $this->model->saveFavorites($request);
    }

    public function getFavorites()
    {
        $contacts = $this->model->getFavoritesByUser();

        return view('home', ['contacts' => $contacts]);
    }
}
