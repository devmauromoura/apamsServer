<?php

namespace ApamsServer\Http\Controllers\API;

use Illuminate\Http\Request;
use ApamsServer\Http\Controllers\Controller;
use ApamsServer\Sponsors;
use ApamsServer\Settings;

class AboutController extends Controller
{
    protected function about(){
        $about = Settings::first()->only('title', 'description');

        return response()->json([
            "message" => "Sucesso",
            "status" => true,
            "data" => $about
        ]);
    }

    protected function sponsors(){
        $sponsors = Sponsors::all();

        return response()->json([
            "message" => "Sucesso",
            "status" => true,
            "data" => $sponsors
        ]);
    }
}
