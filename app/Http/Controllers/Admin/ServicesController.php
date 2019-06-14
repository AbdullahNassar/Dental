<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\Packages;
use DB;

class ServicesController extends Controller {


    public function getIndex() {
        $services = DB::table('services')
            ->select('services.*')
            ->get();

        return view('admin.pages.service.index', compact('services'));
    }

    public function getService($id)
    {
        if (isset($id)) {
        $services = DB::table('services')
            ->select('services.*')
            ->where('id','=', $id)
            ->get();
        return view('admin.pages.service.edit', compact('services'));
        }
    }

    public function getServ($id)
    {
        if (isset($id)) {
        $services = DB::table('services')
            ->select('services.*')
            ->where('id','=', $id)
            ->get();
        return view('admin.pages.service.delete', compact('services'));
        }
    }

    public function deleteServ($id)
    {
        if (isset($id)) {
            DB::table('services')->where('id','=', $id)->delete();
            $services = DB::table('services')
            ->select('services.*')
            ->get();
        return view('admin.pages.service.index', compact('services'));
        }
    }

    public function getAdd() {
        return view('admin.pages.service.add');
    }

    public function insertService(Request $request)
    {
        $image = $request->input('image');
        $active = $request->input('active');
        $_order = $request->input('_order');
        $_header = $request->input('_header');
        $_header_en = $request->input('_header_en');
        $_paragraph = $request->input('_paragraph');
        $_paragraph_en = $request->input('_paragraph_en');
        $a['a1'] = $request->input('a1');
        $a['a2'] = $request->input('a2');
        $a['a3'] = $request->input('a3');
        $a['a4'] = $request->input('a4');
        $a['a5'] = $request->input('a5');
        $a['a6'] = $request->input('a6');

        $object1 = json_encode($a);

        $ad['ad1'] = $request->input('ad1');
        $ad['ad2'] = $request->input('ad2');
        $ad['ad3'] = $request->input('ad3');
        $ad['ad4'] = $request->input('ad4');
        $ad['ad5'] = $request->input('ad5');
        $ad['ad6'] = $request->input('ad6');

        $video = $request->input('video');

        $object2 = json_encode($ad);

        $data = array('image'=>$image,'_header'=>$_header,'_header_en'=>$_header_en,'_paragraph'=>$_paragraph,'_paragraph_en'=>$_paragraph_en,'active'=>$active,'_order'=>$_order,'advantages'=>$object1,'advantages_en'=>$object2,'video'=>$video);

        DB::table('services')->insert($data);

        $services = DB::table('services')
            ->select('services.*')
            ->get();
        return view('admin.pages.service.index', compact('services'));
    }

    public function updateService(Request $request)
    {
        $id = $request->input('s_id');
        $image = $request->input('image');
        $active = $request->input('active');
        $_order = $request->input('_order');
        $_header = $request->input('_header');
        $_header_en = $request->input('_header_en');
        $_paragraph = $request->input('_paragraph');
        $_paragraph_en = $request->input('_paragraph_en');
        $a['a1'] = $request->input('a1');
        $a['a2'] = $request->input('a2');
        $a['a3'] = $request->input('a3');
        $a['a4'] = $request->input('a4');
        $a['a5'] = $request->input('a5');
        $a['a6'] = $request->input('a6');

        $object1 = json_encode($a);

        $ad['ad1'] = $request->input('ad1');
        $ad['ad2'] = $request->input('ad2');
        $ad['ad3'] = $request->input('ad3');
        $ad['ad4'] = $request->input('ad4');
        $ad['ad5'] = $request->input('ad5');
        $ad['ad6'] = $request->input('ad6');

        $video = $request->input('video');

        $object2 = json_encode($ad);


        $data = array('image'=>$image,'_header'=>$_header,'_header_en'=>$_header_en,'_paragraph'=>$_paragraph,'_paragraph_en'=>$_paragraph_en,'active'=>$active,'_order'=>$_order,
            'advantages'=>$object1,'advantages_en'=>$object2,'video'=>$video);

        DB::table('services')
            ->where('id','=', $id)
            ->update($data);

        $services = DB::table('services')
            ->select('services.*')
            ->get();
        return view('admin.pages.service.index', compact('services'));
    }

    public function getData(Request $request)
    {
        $data = DB::table('services_data')
            ->select('services_data.*')
            ->where('id','=', 1)
            ->get();
        return view('admin.pages.service.data', compact('data'));
    }

    public function updateData(Request $request)
    {
        $p1 = $request->input('p1');
        $p1_en = $request->input('p1_en');
        $p2 = $request->input('p2');
        $p2_en = $request->input('p2_en');
        $block1 = $request->input('block1');
        $block2 = $request->input('block2');
        $block3 = $request->input('block3');
        $block4 = $request->input('block4');
        $block1_en = $request->input('block1_en');
        $block2_en = $request->input('block2_en');
        $block3_en = $request->input('block3_en');
        $block4_en = $request->input('block4_en');
        $image = $request->input('image');

        $data = array('p1' => $p1 ,'p1_en' => $p1_en ,
         'p2' => $p2 ,'p2_en' => $p2_en ,
         'block1' => $block1 ,'block1_en' => $block1_en ,
         'block2' => $block2 ,'block2_en' => $block2_en,
         'block3' => $block3 ,'block3_en' => $block3_en,
         'block4' => $block4 ,'block4_en' => $block4_en,
         'image' => $image);
        DB::table('services_data')
            ->where('id', 1)
            ->update($data);

        return view('admin.pages.home');
    }
}
