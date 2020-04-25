<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invitation;
use App\Model\User;
use App\Http\Requests\InvitationRequest;

class InvitationController extends Controller
{

    public function invite(InvitationRequest $request)
    {
        $parameters = $request->all();
        $receiver = User::getOne($parameters['receiver_name']);
        if(!$receiver){
            return 'No receiver found';          
        }
        $sender = self::userIdByToken($request);
        if($sender){
            Invitation::store($sender->user_id,$receiver['id'],$parameters['message']);
            return 'Invitation has been sent.';
        }   
    }

    public function replyToInvitation(Request $request)
    {
        $param = $this->requestHendler($request,'reply');
        if(intval($param) == 0){
            return $param;
        }
        $replyUser = self::userIdByToken($request);
        Invitation::updateInvitation(intval($param),$replyUser->user_id);
    }

    public function rejectInvitation(Request $request)
    {
        $param = $this->requestHendler($request,'reject');
        if(intval($param) == 0){
            return $param;
        }
        $replyUser = self::userIdByToken($request);
        Invitation::rejectInvitation(intval($param),$replyUser->user_id);
    }

    public function getRecivedInvitaion(Request $request)
    {
        $receiver = self::userIdByToken($request);
        if($receiver){   
           return Invitation::getInvitationByReceiver($receiver->user_id);
        }else{
            return 'No messages for receiver';
        }
    }

    public function getSentInvitaion(Request $request)
    {
        $sednder = self::userIdByToken($request);
        if($sednder){   
            return Invitation::getInvitationBySender($sednder->user_id);
        }else{
            return 'No messages for sender.';
        }
    }

    protected static function userIdByToken($request)
    {
        $sender_id = $request->header();  
        $userData = User::getUserByToken($sender_id['token'][0]);
        return $userData->first();
    }

    protected function requestHendler($request,$type)
    {
        $parameter = $request->all();
        if(!$parameter){
            switch($type){
                case 'reply':
                    return 'Send id parametar!';
                break;
                case 'reject':
                    return 'Send id to reply invitation!';
                break;
                default:
                    return 'Send parametar';
            }
        }
        return $parameter['id'];
    }

}
