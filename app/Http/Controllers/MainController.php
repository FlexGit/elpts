<?php

namespace App\Http\Controllers;

use Session;
use App\Doctypes;
use App\Templates;
use App\Docs;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }
}
