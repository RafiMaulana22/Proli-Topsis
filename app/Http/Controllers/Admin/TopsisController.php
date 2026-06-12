<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    public function index()
    {
        return view('Admin.Topsis.topsis_view');
    }
}
