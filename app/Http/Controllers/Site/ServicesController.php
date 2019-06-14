<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use App\Service;
use App\About;
use App\Data;
use DB;

use App\Reservation;

class ServicesController extends Controller {

    public function getIndex() {

        $contact = new Contacts;
        $data = new Data;
        $abouts = new About;

        $services = DB::table('services')
            ->select('services.*')
            ->where('active','=', 1)
            ->get();

        $services_data = DB::table('services_data')
            ->select('services_data.*')
            ->get();

        return view('site.pages.services', compact('contact','abouts','data','services','services_data'));
    }

    public function getService($id) {

        if (isset($id)) {

        $contact = new Contacts;
        $data = new Data;
        $abouts = new About;

        $services = DB::table('services')
            ->select('services.*')
            ->where('id','=', $id)
            ->get();

        $counts = DB::table('services')
            ->select('services.*')
            ->where('active','=', 1)
            ->get();

        $services_data = DB::table('services_data')
            ->select('services_data.*')
            ->get();

        return view('site.pages.service', compact('contact','abouts','data','services','counts','services_data'));
        }
    }

}
