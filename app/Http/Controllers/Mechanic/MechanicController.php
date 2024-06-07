<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function index()
    {
       
        return view('mechanic.dashboard');
    }
}
