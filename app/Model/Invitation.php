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
        'id_sender','id_reciver','message','status'
    ];

    public static function store($id_sender,$id_reciver,$message){

        $storeInvitation  = new Invitation();
        $storeInvitation['id_sender'] = $id_sender;
        $storeInvitation['id_reciver'] = $id_reciver;
        $storeInvitation['message'] = $message;
        $storeInvitation['status'] = 0;
        $storeInvitation->save();
    }

    public static function getInvitation($id_invite,$id_reciver){
        $updated = Invitation::where(['id_reciver' => $id_reciver, 'id' => $id_invite])->first();
        $updated['status'] = 1;
        $updated->save();
    }

    public static function getInvitationBySender($id_sender){
        return Invitation::where('id_sender',$id_sender)->get();
    }

    public static function getInvitationByReciver($id_reciver){
        return Invitation::where('id_reciver',$id_reciver)->get();
    }
}
