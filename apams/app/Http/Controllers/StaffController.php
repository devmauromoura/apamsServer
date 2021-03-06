<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Staff;
use Auth;
use Hash;
use Illuminate\Support\Facades\Mail;
use ApamsServer\Mail\RecoveryStaff;
use Illuminate\Support\Str;

class StaffController extends Controller
{

    public function recovery(Request $request, $email){
        $user = Staff::where('email', $email)->first();
        $random = Str::random(8);
        $update = Staff::find($user['id']);
        $update->password = Hash::make($random);
        try {
            $update->save();
            $recoveryData = array(
                "name" => $user->name,
                "newpassword" => $random
            );
           Mail::to($email)->send(new RecoveryStaff($recoveryData));

           return response()->json([
                "message" => "Redefinição realizada.",
                "status" => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => 'Ocorreu algum problema.',
                "status" => false
            ], 400);
        }

        return $data;
    }

    public function index()
    {
        $permissoes = json_decode(Auth::user()->permissoes);

        $visualizar = (in_array("userV", $permissoes)) ? true : false;
        $cadastrar = (in_array("userC", $permissoes)) ? true : false;
        $editar = (in_array("userE", $permissoes)) ? true : false;
        $remover = (in_array("userR", $permissoes)) ? true : false;

        if($visualizar == false && $cadastrar == false && $editar == false && $remover == false){
            return redirect()->back()->with('danger','Sem permissão para prosseguir!');
        }

        $nameUserAuth = Auth::user()->name;
        $avatarUserAuth = Auth::user()->avatar;
        return view('users/users')->with('nameUserAuth',$nameUserAuth)->with('avatarUserAuth',$avatarUserAuth)->with('permissoes',$permissoes);
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

        if(isset($request['edit_configuracao']))
            $permissoes[] = 'configuracaoE';

        try {
            $saveUser = new Staff;

            $saveUser->name = $request['nome'];
            $saveUser->email = $request['email'];
            $saveUser->password = Hash::make($request['senha']);
            if(isset($request['images'])){
                $saveUser->avatar = "storage/users_avatar/{$nomeimg}";
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

        if(isset($request['edit_configuracao']))
            $permissoes[] = 'configuracaoE';


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
                $saveUser->avatar = "storage/users_avatar/{$nomeimg}";
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
