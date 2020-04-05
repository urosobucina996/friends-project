<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    //
    protected $table = 'invitations';

    /**
     * @var array
     */
    protected $filable = [
        'id_sender','id_receiver','message','status'
    ];

    public static function store($id_sender,$id_receiver,$message){


        $storeInvitation  = new Invitation();
        $storeInvitation['id_sender'] = $id_sender;
        $storeInvitation['id_receiver'] = $id_receiver;
        $storeInvitation['message'] = $message;
        $storeInvitation->save();
    }

    public static function updateInvitation($id_invite,$id_receiver){
        $updated = Invitation::where(['id_receiver' => $id_receiver, 'id' => $id_invite])->first();
        if($updated){
            $updated['status'] = 1;
            $updated->save();
        }
    }

    public static function rejectInvitation($id_invite,$id_receiver){
        $updated = Invitation::where(['id_receiver' => $id_receiver, 'id' => $id_invite])->first();
        if($updated){
            $updated['status'] = 0;
            $updated->save();
        }
    }

    public static function getInvitationBySender($id_sender){
        return Invitation::where('id_sender',$id_sender)->get();
    }

    public static function getInvitationByReciver($id_receiver){
        return Invitation::where('id_receiver',$id_receiver)->get();
    }
}
