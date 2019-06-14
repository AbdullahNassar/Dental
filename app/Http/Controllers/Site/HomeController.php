<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use App\Service;
use App\About;
use App\Data;
use DB;

class HomeController extends Controller {

    public function getIndex() {

    	$about = DB::table('about')
                  ->select('about.*')
                  ->where('id','=', 1)
                  ->get();

        $sliders = DB::table('sliders')
            ->select('sliders.*')
            ->where('active','=', 1)
            ->get();

        $services = DB::table('services')
            ->select('services.*')
            ->where('active','=', 1)
            ->get();

        $doctors = DB::table('doctors')
            ->select('doctors.*')
            ->where('active','=', 1)
            ->get();

        $stories = DB::table('stories')
            ->select('stories.*')
            ->where('active','=', 1)
            ->get();

    	$contact = new Contacts;
    	$data = new Data;
    	$service = new Service;
    	$abouts = new About;
        return view('site.pages.home', compact('contact','about','abouts','sliders','data','services','doctors','stories','service'));
    }

    public function getBook() {
    	$contact = new Contacts;
    	$data = new Data;
    	$abouts = new About;
    	return view('site.pages.book', compact('contact','abouts','data'));
    }

    public function postBook(Request $request) {
    	$full_name = $request->input('full_name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $book_date = $request->input('book_date');
        $book_time = $request->input('book_time');
        $message = $request->input('message');

        $data = array('name'=>$full_name,
        	'gender'=>$gender,'date'=>$book_date,'time'=>$book_time,
            'email'=>$email,'phone'=>$phone,'message'=>$message);

        DB::table('reservations')->insert($data);
        return back();
    }

}
