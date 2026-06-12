<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        return view('Admin.SubKriteria.index');
    }
}
