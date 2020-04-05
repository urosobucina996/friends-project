<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invitation;
use App\Model\User;
use App\Http\Requests\InvitationRequest;

class InvitationController extends Controller
{
    //
    public function invite(InvitationRequest $request){
        
        $parameters = $request->all();
        $receiver = User::getOne($parameters['receiver_name']);
        if($receiver['id']){
            $sender = self::userIdByToken($request);
            if($sender){
                Invitation::store($sender->user_id,$receiver['id'],$parameters['message']);
                return 'Invitation has been sent.';
            }            
        }
        return 'No receiver found';
    }

    public function replyToInvitation(Request $request){
        
        $parameter = $request->all();
        if($parameter['id']){   
            $replyUser = self::userIdByToken($request);
            $updateInvitation = Invitation::updateInvitation($parameter['id'],$replyUser->user_id);
        }else{
            return '';
        }
    }

    public function getRecivedInvitaion(Request $request){

        $receiver = self::userIdByToken($request);
        if($receiver){   
           return Invitation::getInvitationByreceiver($receiver->user_id);
        }else{
            return 'No messages for receiver';
        }
    }

    public function getSentInvitaion(Request $request){
        
        $sednder = self::userIdByToken($request);
        if($sednder){   
            return Invitation::getInvitationBySender($sednder->user_id);
        }else{
            return 'No messages for sender.';
        }
    }

    protected static function userIdByToken($request){

        $sender_id = $request->header();  
        $userData = User::getUserByToken($sender_id['token'][0]);
        return $userData->first();
    }

}
