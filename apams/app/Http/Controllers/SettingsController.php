<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use ApamsServer\Settings;
use GuzzleHttp\Client;


class SettingsController extends Controller
{
    
    public function index()
    {
        $permissoes = json_decode(Auth::user()->permissoes);

        $editar = (in_array("configuracaoE", $permissoes)) ? true : false;

        if($editar == false){
            return redirect()->back()->with('danger','Sem permissão para prosseguir!');
        }

        $settings = new Settings;
        $settings = $settings::find(1);
        $nameUserAuth = Auth::user()->name;
        $avatarUserAuth = Auth::user()->avatar;
        return view('configuracoes/configuracoes')->with('nameUserAuth',$nameUserAuth)
                                                  ->with('avatarUserAuth',$avatarUserAuth)
                                                  ->with('dados',$settings);
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
