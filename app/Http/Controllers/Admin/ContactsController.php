<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use DB;

class ContactsController extends Controller {

	public function getContacts()
    {
        $contacts = DB::table('contacts')
            ->select('contacts.*')
            ->where('id','=', 1)
            ->get();
        $con = new Contacts;
        return view('admin.pages.contact', compact('contacts','con'));
    }


    public function updateContacts(Request $request)
    {
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');
        $address_en = $request->input('address_en');
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $google = $request->input('google');
        $instagram = $request->input('instagram');
        $youtube = $request->input('youtube');

        $time['time1'] = $request->input('time1');
        $time['time2'] = $request->input('time2');
        $time['time3'] = $request->input('time3');
        $time['time4'] = $request->input('time4');

        $object1 = json_encode($time);

        $time_en['time_en1'] = $request->input('time_en1');
        $time_en['time_en2'] = $request->input('time_en2');
        $time_en['time_en3'] = $request->input('time_en3');
        $time_en['time_en4'] = $request->input('time_en4');

        $object2 = json_encode($time_en);

        $data = array('phone' => $phone ,'email' => $email ,
         'address' => $address ,'address_en' => $address_en ,
         'time' => $object1 ,'time_en' => $object2 ,
         'facebook' => $facebook ,'twitter' => $twitter ,
         'google' => $google ,'instagram' => $instagram,'youtube' => $youtube);
        DB::table('contacts')
            ->where('id', 1)
            ->update($data);

        return view('admin.pages.home');
    }
}
