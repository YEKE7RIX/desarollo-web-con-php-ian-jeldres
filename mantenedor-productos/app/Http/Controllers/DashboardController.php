<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        if(!session()->has('usuario')){
            return redirect()->route('login');
        }

        return view('dashboard');
    }
}