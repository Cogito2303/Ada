<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    //
    public function index(Request $request) {
        $data = $request->all();
        // $nomEnfant = $data['nomEnfant'];
        return view('confirm', ['data' => $data]);
    }
}
