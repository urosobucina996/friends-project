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
        //TODO ispitaj da li je ulogovan i od njega izmi ID
        $parameters = $request->all();
        $sender_id = $request->header();
        $reciver = User::getOne($parameters['reciver_name']);
        if($reciver['id']){
            $sender = User::getUserByToken($sender_id['token'][0]);
            $senderInfo = $sender->first();
            if($senderInfo){
                Invitation::store($senderInfo->user_id,$reciver['id'],$parameters['message']);
                return 'Invitation has been sent.';
            }            
        }
        return 'No Reciver found';
    }

    public function replyToInvite(Request $request){
        
        $parameter = $request->all();
        if($parameter['id']){   
            $updateInvitation = Invitation::getInvitation($parameter['id'],2);
        }else{
            return '';
        }
    }

    public function getRecivedInvitaion(Request $request){
        $parameter = $request->all();
        if($parameter['id_reciver']){   
           return Invitation::getInvitationByReciver($parameter['id_reciver']);
        }else{
            return 'No messages for revicer';
        }
    }

    public function getSentInvitaion(Request $request){
        $parameter = $request->all();
        if($parameter['id_sender']){   
            return Invitation::getInvitationBySender($parameter['id_sender']);
        }else{
            return 'No messages for sender.';
        }
    }

}
