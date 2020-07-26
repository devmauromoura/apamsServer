<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Sponsors;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Auth;


class PatrocionadorController extends Controller
{

    public function index()
    {
        $permissoes = json_decode(Auth::user()->permissoes);

        $visualizar = (in_array("patrocinadorV", $permissoes)) ? true : false;
        $cadastrar = (in_array("patrocinadorC", $permissoes)) ? true : false;
        $editar = (in_array("patrocinadorE", $permissoes)) ? true : false;
        $remover = (in_array("patrocinadorR", $permissoes)) ? true : false;

        if($visualizar == false && $cadastrar == false && $editar == false && $remover == false){
            return redirect()->back()->with('danger','Sem permissão para prosseguir!');
        }

        $nameUserAuth = Auth::user()->name;
        $avatarUserAuth = Auth::user()->avatar;
        return view('patrocinadores/patrocinadores')->with('nameUserAuth',$nameUserAuth)->with('avatarUserAuth',$avatarUserAuth)->with('permissoes',$permissoes);
    }

    public function getDados()
    {
        $data = Sponsors::all();
        return response()->json(['data' => $data]);
    }

    public function formulario($id=null)
    {
        $data = [];

        if($id){
            $data = Sponsors::find($id);
        }
        return view('patrocinadores/patrocinadores_formulario')->with('dados',$data);
    }

    public function salvar(Request $request)
    {
        if($request['images']){
            try {
                $ext = $request->file('images')[0]->extension();
                $nome = kebab_case($request['nome']);
                $data = date('d-m-Y_H-i-s');
                $nomeimg = "logo{$nome}{$data}.{$ext}";

                $saveStorage = $request->file('images')[0]->storeAs('patrocinadores',$nomeimg); 
            } catch (\Throwable $th) {
                return redirect('patrocinadores')->with('danger', 'Erro ao cadastrar o patrocinador! [IMG]');
            }
        }

        try {

            $newPatrocinador = new Sponsors;
            $newPatrocinador->name = $request['nome'];
            $newPatrocinador->email = $request['email'];
            $newPatrocinador->cellphone = $request['contato'];
            $newPatrocinador->description = $request['descricao'];
            if($request['images']){
                $newPatrocinador->avatar = "storage/patrocinadores/{$nomeimg}";
            }

            $newPatrocinador->save();

        } catch (\Throwable $th) {
            return redirect('patrocinadores')->with('danger', 'Erro ao cadastrar o patrocinador! [BD]');
        }

        return redirect('patrocinadores')->with('success', 'Patrocinador cadastrado com sucesso!');
    }

    public function editar(Request $request, $id)
    {

        if(isset($request['images']))
        {
            try {
                $ext = $request->file('images')[0]->extension();
                $nome = kebab_case($request['nome']);
                $data = date('d-m-Y_H-i-s');
                $nomeimg = "logo{$nome}{$data}.{$ext}";

                $saveStorage = $request->file('images')[0]->storeAs('patrocinadores',$nomeimg);
            } catch (\Throwable $th) {
                return redirect('patrocinadores')->with('danger', 'Erro ao cadastrar o post! [IMG]');
            }
        }

        try {
            $upPatrocinador = new Sponsors;
            $upPatrocinador = $upPatrocinador::find($id);
            $upPatrocinador->name = $request['nome'];
            $upPatrocinador->email = $request['email'];
            $upPatrocinador->cellphone = $request['contato'];
            $upPatrocinador->description = $request['descricao'];
            if(isset($request['images'])){
                $upPatrocinador->avatar = "storage/patrocinadores/{$nomeimg}";
            } elseif (!isset($request['images']) && !isset($request['preloaded'])) {
                $upPatrocinador->avatar = "";
            }
            $upPatrocinador->save();
        } catch (\Throwable $th) {
            return redirect('patrocinadores')->with('danger', 'Erro ao editar o patrocinador.');
        }

        return redirect('patrocinadores')->with('success', 'Patrocinador editado com sucesso!');
    }

    public function remover(Request $request, $id)
    {
        try {
            $postDelete = new Sponsors;
            $postDelete = $postDelete::find($id);
            $postDelete->delete();
    
            return redirect('patrocinadores')->with('success', 'Patrocinador removido com sucesso!');
        } catch (\Throwable $th) {
            return redirect('patrocinadores')->with('danger', 'Erro ao remover o patrocinador!');
        }
    }

}
