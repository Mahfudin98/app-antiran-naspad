<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeAdminController extends Controller
{
    public function index()
    {
        return view('homeadmin.index', ['users' => DB::table('users')->count(), 'products' => DB::table('products')->count()]);
    }
}
