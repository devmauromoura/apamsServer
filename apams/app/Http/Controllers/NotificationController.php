<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Notification;
use View;
use ApamsServer\User;
use Auth;
use ApamsServer\Sponsors;
use DB;

class NotificationController extends Controller
{
	public function show(){
		$nameUserAuth = Auth::user()->name;
		//$dataNotification = Notification::all();
		$dataNotification = DB::table('notification')->leftJoin('sponsor','idPatrocinador','=','sponsor.id')->select(DB::raw('notification.id,  notification.title, notification.description, notification.status, sponsor.name AS sname'))->get();
		$dataSponsors = Sponsors::all();
		
		return View::make('notification')->with(compact('dataNotification'))->with(compact('nameUserAuth'))->with(compact('dataSponsors'));	
	}

	protected function create(Request $request){
		$dataUpdate = $request->all();
		$notif = new Notification;
		$notif->title = $dataUpdate['tituloNot']; 
		$notif->description = $dataUpdate['descriptionNot'];
		$notif->idPatrocinador = $dataUpdate['patroNot'];
		$notif->status = $dataUpdate['statusNot'];
		$notif->save();

		return redirect('notificacoes');
	}


}

