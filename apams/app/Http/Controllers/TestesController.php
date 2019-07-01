<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Google;

class TestesController extends Controller
{
    public function getat(){
        $retornoModel = new Google;

        return $retornoModel->getAcessToken();
    }
}
