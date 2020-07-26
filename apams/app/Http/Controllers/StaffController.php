<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Staff;
use Auth;
use Hash;

class StaffController extends Controller
{

    public function index()
    {
        $nameUserAuth = Auth::user()->name;
        $avatarUserAuth = Auth::user()->avatar;
        return view('users/users')->with('nameUserAuth',$nameUserAuth)->with('avatarUserAuth',$avatarUserAuth);
    }

    public function getDados()
    {
        $dataUser = Staff::all();
        return response()->json(['data' => $dataUser]);
    }

    public function formulario($id=null)
    {

        $data = [];

        if($id){
            $data = Staff::find($id);
        }
        return view('users/users_formulario')->with('dados',$data);
    }

    public function salvar(Request $request)
    {
        $usuarios = new Staff;
        $checkuser = $usuarios::where('email','=',$request['email'])->get();

        if(count($checkuser) > 0){
            return redirect('usuarios')->with('danger', 'Email ja utilizado!');
        }

        if(isset($request['images'])){
            try {
                $ext = $request->file('images')[0]->extension();
                $data = date('d-m-Y_H-i-s');
                $nome = kebab_case($request['nome']);
                $nomeimg = "avatar_{$nome}_{$data}.{$ext}";
    
                $saveStorage = $request->file('images')[0]->storeAs('users_avatar',$nomeimg); 
            } catch (\Throwable $th) {
                return redirect('usuarios')->with('danger', 'Erro ao cadastrar o usuário! [IMG]');
            }
        }

        $permissoes = [];

        if(isset($request['vis_post']))
            $permissoes[] = 'postV';
        if(isset($request['cad_post']))
            $permissoes[] = 'postC';
        if(isset($request['edit_post']))
            $permissoes[] = 'postE';
        if(isset($request['del_post']))
            $permissoes[] = 'postR';

        if(isset($request['vis_animal']))
            $permissoes[] = 'animalV';
        if(isset($request['cad_animal']))
            $permissoes[] = 'animalC';
        if(isset($request['edit_animal']))
            $permissoes[] = 'animalE';
        if(isset($request['del_animal']))
            $permissoes[] = 'animalR';

        if(isset($request['vis_user']))
            $permissoes[] = 'userV';
        if(isset($request['cad_user']))
            $permissoes[] = 'userC';
        if(isset($request['edit_user']))
            $permissoes[] = 'userE';
        if(isset($request['del_user']))
            $permissoes[] = 'userR';

        if(isset($request['vis_patrocinador']))
            $permissoes[] = 'patrocinadorV';
        if(isset($request['cad_patrocinador']))
            $permissoes[] = 'patrocinadorC';
        if(isset($request['edit_patrocinador']))
            $permissoes[] = 'patrocinadorE';
        if(isset($request['del_patrocinador']))
            $permissoes[] = 'patrocinadorR';

        try {
            $saveUser = new Staff;

            $saveUser->name = $request['nome'];
            $saveUser->email = $request['email'];
            $saveUser->password = Hash::make($request['senha']);
            if(isset($request['images'])){
                $saveUser->avatar = $nomeimg;
            }
            $saveUser->permissoes = json_encode($permissoes);
    
            $saveUser->save();
        } catch (\Throwable $th) {
            return redirect('usuarios')->with('danger', 'Erro ao cadastrar o usuário! [BD]');
        }

        return redirect('usuarios')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function editar(Request $request, $id)
    {
        if(isset($request['images'])){
            try {
                $ext = $request->file('images')[0]->extension();
                $data = date('d-m-Y_H-i-s');
                $nome = kebab_case($request['nome']);
                $nomeimg = "avatar_{$nome}_{$data}.{$ext}";
    
                $saveStorage = $request->file('images')[0]->storeAs('users_avatar',$nomeimg); 
            } catch (\Throwable $th) {
                return redirect('usuarios')->with('danger', 'Erro ao editar o usuário! [IMG]');
            }
        }

        $permissoes = [];

        if(isset($request['vis_post']))
            $permissoes[] = 'postV';
        if(isset($request['cad_post']))
            $permissoes[] = 'postC';
        if(isset($request['edit_post']))
            $permissoes[] = 'postE';
        if(isset($request['del_post']))
            $permissoes[] = 'postR';

        if(isset($request['vis_animal']))
            $permissoes[] = 'animalV';
        if(isset($request['cad_animal']))
            $permissoes[] = 'animalC';
        if(isset($request['edit_animal']))
            $permissoes[] = 'animalE';
        if(isset($request['del_animal']))
            $permissoes[] = 'animalR';

        if(isset($request['vis_user']))
            $permissoes[] = 'userV';
        if(isset($request['cad_user']))
            $permissoes[] = 'userC';
        if(isset($request['edit_user']))
            $permissoes[] = 'userE';
        if(isset($request['del_user']))
            $permissoes[] = 'userR';

        if(isset($request['vis_patrocinador']))
            $permissoes[] = 'patrocinadorV';
        if(isset($request['cad_patrocinador']))
            $permissoes[] = 'patrocinadorC';
        if(isset($request['edit_patrocinador']))
            $permissoes[] = 'patrocinadorE';
        if(isset($request['del_patrocinador']))
            $permissoes[] = 'patrocinadorR';

        try {
            $saveUser = new Staff;
            $saveUser = $saveUser::find($id);

            $saveUser->name = $request['nome'];
            $saveUser->email = $request['email'];
            $saveUser->permissoes = json_encode($permissoes);

            if($request['senha'] !== null){
                $saveUser->password = Hash::make($request['senha']);
            }

            if(isset($request['images'])){
                $saveUser->avatar = $nomeimg;
            } elseif (!isset($request['images']) && !isset($request['preloaded'])) {
                $saveUser->avatar = "";
            }
            
            $saveUser->save();
        } catch (\Throwable $th) {
            return redirect('usuarios')->with('danger', 'Erro ao editar o usuário! [BD]');
        }

        return redirect('usuarios')->with('success', 'Usuário editado com sucesso!');
    }

    public function remover(Request $request, $id)
    {
        try {
            $postDelete = new Staff;
            $postDelete = $postDelete::find($id);
            $postDelete->delete();
    
            return redirect('usuarios')->with('success', 'Usuário removido com sucesso!');
        } catch (\Throwable $th) {
            return redirect('usuarios')->with('danger', 'Erro ao remover o usuário!');
        }
    }
    
}
