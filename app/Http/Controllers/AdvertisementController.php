<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index(){
        $advertisements = Advertisement::orderBy('created_at', 'desc')->paginate(9);

        return view('jobs.index', compact('advertisements'));
    }
}
