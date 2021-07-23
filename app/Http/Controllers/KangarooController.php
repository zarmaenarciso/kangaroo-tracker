<?php

namespace App\Http\Controllers;

use App\Kangaroo;
use Illuminate\Http\Request;

class KangarooController extends Controller
{
    public function index()
    {
        return view('contents.index');
    }

    public function create()
    {
        return view('contents.create');
    }

    public function edit(Kangaroo $kangaroo)
    {
        return view('contents.edit', compact('kangaroo'));
    }
}
