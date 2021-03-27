<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theatre;
use App\Models\Booking;
use Auth;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }    
}