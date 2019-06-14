<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services;
use App\Packages;
use DB;

class PackagesController extends Controller {


    public function getIndex() {
        $packages = DB::table('packages')
                    ->join('services', 'services.id', '=', 'packages.service')
                    ->select('packages.*','services.name')
                    ->get();

        return view('admin.pages.packages.index', compact('packages'));
    }

    public function getPackage($id)
    {
        if (isset($id)) {
            $packages = DB::table('packages')
                ->select('packages.*')
                ->where('id','=', $id)
                ->get();

            $s_packages = DB::table('program')
                ->join('packages', 'packages.id', '=', 'program.package')
                ->select('program.*')
                ->where('packages.id', '=', $id)
                ->get();

            $t_packages = DB::table('services')
                ->select('services.*')
                ->get();

            $prices = DB::table('packages')
            ->select('price')
            ->where('id', '=', $id)
            ->get();

        return view('admin.pages.packages.edit', compact('packages','t_packages','s_packages','prices'));
        }
    }

    public function getPack($id)
    {
        if (isset($id)) {
        $packages = DB::table('packages')
            ->select('packages.*')
            ->where('id','=', $id)
            ->get();

        $prices = DB::table('packages')
            ->select('price')
            ->where('id', '=', $id)
            ->get();
        return view('admin.pages.packages.delete', compact('packages','prices'));
        }
    }

    public function deletePack($id)
    {
        if (isset($id)) {
            DB::table('packages')->where('id','=', $id)->delete();
            return back();
        }
    }

    public function getAdd() {
        $t_packages = DB::table('packages')
            ->select('packages.*')
            ->get();

        $s_packages = DB::table('services')
                ->select('services.*')
                ->get();
        return view('admin.pages.packages.add', compact('t_packages','s_packages'));
    }

    public function insertPackage(Request $request)
    {
        $image = $request->input('image');
        $service_ar = $request->input('service_ar');
        $name_ar = $request->input('name_ar');
        $name_en = $request->input('name_en');
        $content_ar = $request->input('content_ar');
        $content_en = $request->input('content_en');
        $details_ar = $request->input('details_ar');
        $details_en = $request->input('details_en');
        $view = $request->input('view');
        $active = $request->input('active');
        $_order = $request->input('_order');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $residence_ar = $request->input('residence_ar');
        $residence_en = $request->input('residence_en');
        $program_title = $request->input('program_title');
        $program_title_en = $request->input('program_title_en');
        $program_description = $request->input('program_description');
        $program_d_en = $request->input('program_d_en');
        $program_order = $request->input('program_order');
        $number = $request->input('number');
//---------------------------------------------------------------------------------
        $price['price1'] = $request->input('price');
        $price['price2'] = $request->input('price2');
        $price['price3'] = $request->input('price3');

        $object = json_encode($price);
//---------------------------------------------------------------------------------
        $price_order = $request->input('price_order');
        
        $data = array(
            'service'=>$service_ar,
            'title'=>$name_ar,
            'title_en'=>$name_en,
            'content'=>$content_ar,
            'content_en'=>$content_en,
            'details'=>$details_ar,
            'details_en'=>$details_en,
            'image'=>$image,
            'active'=>$active,
            '_order'=>$_order,
            'view'=>$view,
            'date_from'=>$date_from,
            'date_to'=>$date_to,
            'residence'=>$residence_ar,
            'residence_en'=>$residence_en,
            'number'=>$number,
            'price'=>$object,
            'price_order'=>$price_order
            );

        DB::table('packages')->insert($data);
        return back();
    }

    public function updatePackage(Request $request)
    {
        $id = $request->input('s_id');
        $service_ar = $request->input('service_ar');
        $image = $request->input('image');
        $name_ar = $request->input('name_ar');
        $name_en = $request->input('name_en');
        $content_ar = $request->input('content_ar');
        $content_en = $request->input('content_en');
        $details_ar = $request->input('details_ar');
        $details_en = $request->input('details_en');
        $view = $request->input('view');
        $active = $request->input('active');
        $_order = $request->input('_order');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $residence_ar = $request->input('residence_ar');
        $residence_en = $request->input('residence_en');
        $number = $request->input('number');
//---------------------------------------------------------------------------------
        $price['price1'] = $request->input('p1');
        $price['price2'] = $request->input('p2');
        $price['price3'] = $request->input('p3');

        $object = json_encode($price);
//---------------------------------------------------------------------------------
        $price_order = $request->input('price_order');
        
        $data = array(
            'service'=>$service_ar,
            'title'=>$name_ar,
            'title_en'=>$name_en,
            'content'=>$content_ar,
            'content_en'=>$content_en,
            'details'=>$details_ar,
            'details_en'=>$details_en,
            'image'=>$image,
            'active'=>$active,
            '_order'=>$_order,
            'view'=>$view,
            'date_from'=>$date_from,
            'date_to'=>$date_to,
            'residence'=>$residence_ar,
            'residence_en'=>$residence_en,
            'number'=>$number,
            'price'=>$object,
            'price_order'=>$price_order
            );

        DB::table('packages')
            ->where('id','=', $id)
            ->update($data);

        return back();
    }

}
