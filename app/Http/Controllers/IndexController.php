<?php

namespace App\Http\Controllers;

use App\Models\Ad;

class IndexController extends Controller
{

    public function index()
    {

        $ads = Ad::query()
            ->where('index', '=', 1)
            ->orderBy('priority')
            ->get();

        return view('front.index.index', [
            'ads' => $ads
        ]);
    }
}
