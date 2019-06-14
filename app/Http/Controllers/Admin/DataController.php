<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use DB;

class DataController extends Controller {

	public function getData()
    {
        $contacts = DB::table('data')
            ->select('data.*')
            ->where('id','=', 1)
            ->get();
        return view('admin.pages.data', compact('contacts'));
    }


    public function updateData(Request $request)
    {
        $services = $request->input('services');
        $services_en = $request->input('services_en');
        $doctors = $request->input('doctors');
        $doctors_en = $request->input('doctors_en');
        $stories = $request->input('stories');
        $stories_en = $request->input('stories_en');
        $contacts = $request->input('contacts');
        $contacts_en = $request->input('contacts_en');
        $subscribe = $request->input('subscribe');
        $subscribe_en = $request->input('subscribe_en');
        $blog = $request->input('blog');
        $blog_en = $request->input('blog_en');

        $data = array('services' => $services ,'services_en' => $services_en ,
         'doctors' => $doctors ,'doctors_en' => $doctors_en ,
         'stories' => $stories ,'stories_en' => $stories_en ,
         'contacts' => $contacts ,'contacts_en' => $contacts_en,
         'subscribe' => $subscribe,'subscribe_en' => $subscribe_en,
         'blog' => $blog,'blog_en' => $blog_en);
        DB::table('data')
            ->where('id', 1)
            ->update($data);

        return view('admin.pages.home');
    }
}
