<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Nette\Utils\Html;

class NewMatchController extends Controller
{
    public function index() : View
    {
        return view('new_match_page');
    }
}
