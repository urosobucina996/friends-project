<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invitation;

class InvitationController extends Controller
{
    //
    public function invite(Request $request){
        //TODO ispitaj da li je ulogovan i od njega izmi ID
        Invitation::store($request->all());
        dd($request->all());

    }
}
