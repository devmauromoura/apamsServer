<?php

namespace ApamsServer;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Google extends Model
{
    public function printModel($data){
        //$dateCurrent = date_create();
        //$um = date_create();
       // $dois = date_create();
        
        //$currentDateTime = date_format($dateCurrent, 'U');
       // $dateTimeExp = date_format($dateCurrent,'Y-m-d H:i:s');
       // $sendDateTime = strtotime($dateTimeExp.'+1 hours');

        /*date_timestamp_set($um, 1561953261);
        date_timestamp_set($dois, 1561956861);

        echo date_format($um, 'U = Y-m-d H:i:s') . "<br>";
        echo date_format($dois, 'U = Y-m-d H:i:s') . "\n"; */

       // return "Atual: ".$currentDateTime."<br> Envio: ".$sendDateTime;
        
        //date_timestamp_set($date, 1171502725);
       // echo date_format($date, 'U = Y-m-d H:i:s') . "\n";


    }

    ## FUNÇÃO PARA REQUISITAR ACCESS TOKEN GOOGLE ##
    public function getAcessToken(){
        
        //  Hora de registro e validade para o token em UTC
        $dateCurrent = date_create();
        $currentDateTime = date_format($dateCurrent, 'U');
        $dateTimeExp = date_format($dateCurrent,'Y-m-d H:i:s');
        $sendDateTime = strtotime($dateTimeExp.'+1 hours');
        

        // Dados para contrutir o JWT para envio
        $jwtHeader = '{"alg":"RS256","typ":"JWT"}';
        $jwtClaimSet =  '{"iss": "storageapams-1559827945886@appspot.gserviceaccount.com","sub": "devmauromoura@gmail.com","scope": "https://www.googleapis.com/auth/photoslibrary.readonly","aud": "https://www.googleapis.com/oauth2/v4/token","exp": '.$sendDateTime.',"iat": '.$currentDateTime.'}';
        
        // Conversão dos dados para Base64
        $jwtHeaderEncoded =  base64_encode($jwtHeader);
        $jwtClaimSetEncoded =  base64_encode($jwtClaimSet);

        // Finalização do JWT
        $jwt = $jwtHeaderEncoded.".".$jwtClaimSetEncoded;

      /* $postGoogle = new Client();
        $responsepostGoogle = $postGoogle->post('https://www.googleapis.com/oauth2/v4/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ],
            'headers' => [
                'Conten-Type' => 'application/x-www-form-urlencoded'
            ],
        ]); */

        echo "currentDateTime: ".$currentDateTime."\n";
        echo "sendDateTime: ".$sendDateTime."\n";
        echo "jwt: ".$jwt."\n";

        

       // return $responsepostGoogle = json_decode($responsepostGoogle->getBody(), true);
        
        

    }


}
