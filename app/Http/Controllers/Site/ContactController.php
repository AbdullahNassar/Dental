<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Contacts;
use App\Data;
use App\About;
use DB;

class ContactController extends Controller {

    public function getIndex() {

        $data = new Data;
        $contact = new Contacts;
        $abouts = new About;
        return view('site.pages.contact',compact('data','contact','abouts'));
    }

    public function message(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $message = $request->input('message');
        $data = array('first_name'=>$first_name,'last_name'=>$last_name,
            'email'=>$email,'phone'=>$phone,'message'=>$message);

        DB::table('messages')->insert($data);
        return back();
    }

}
