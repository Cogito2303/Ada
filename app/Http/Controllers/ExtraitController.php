<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtraitController extends Controller
{
    //
    public function afficherExtrait(Request $request)
{
    $data = json_decode($request->query('data'), true);

    return view('extrait', compact('data'));
}
}
