<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class roomController extends Controller
{
    public function room_page(){
        return view('adminView.room');
    }
}
