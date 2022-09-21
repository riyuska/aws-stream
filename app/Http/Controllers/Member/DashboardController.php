<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(auth()->user());

        $movies = Movie::orderBy('featured', 'DESC')
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('member.dashboard', ['movies' => $movies]);
    }
}