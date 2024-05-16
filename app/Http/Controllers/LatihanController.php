<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index()
    {
        return "Ini dicetak dari controller";
    }

    public function beranda()
    {
        $data = array('nama' => 'Albert Chandra');
        return view('beranda', $data);
    }
}
