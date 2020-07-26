<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use GuzzleHttp\Client;
use ApamsServer\Settings;

class ConfiguracoesController extends Controller
{
    public function index()
    {
        $nameUserAuth = Auth::user()->name;
        $settings = new Settings;
        $settings = $settings::find(1);

        return view('configuracoes/configuracoes')->with('nameUserAuth',$nameUserAuth)->with('dados',$settings);
    }

    public function salvar(Request $request)
    {
        try {
            $settings = new Settings;
            $settings = $settings::find(1);
    
            $settings->adopt_mail = $request['email'];
            $settings->title = $request['titulo'];
            $settings->description = $request['descricao'];
    
            $settings->save();
        } catch (\Throwable $th) {
            return redirect('configuracoes')->with('danger', 'Erro ao salvar as configurações!');
        }

        return redirect('configuracoes')->with('success', 'Configurações salvas com sucesso!');
    }
}
