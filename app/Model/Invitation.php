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
        'id_sender','id_reciver','massage','status'
    ];

    public static function store($data){
        dd('model',$data);
        //$invitation = new Invitation();
    }
}
