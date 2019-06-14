<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctors;
use DB;

class DoctorsController extends Controller {


    public function getIndex() {
        $doctors = DB::table('doctors')
                    ->select('doctors.*')
                    ->get();

        return view('admin.pages.doctors.index', compact('doctors'));
    }

    public function getDoctor($id)
    {
        if (isset($id)) {
            $doctors = DB::table('doctors')
                ->select('doctors.*')
                ->where('id','=', $id)
                ->get();

        return view('admin.pages.doctors.edit', compact('doctors'));
        }
    }

    public function getDoc($id)
    {
        if (isset($id)) {
        $doctors = DB::table('doctors')
            ->select('doctors.*')
            ->where('id','=', $id)
            ->get();

        return view('admin.pages.doctors.delete', compact('doctors'));
        }
    }

    public function deleteDoctor($id)
    {
        if (isset($id)) {
            DB::table('doctors')->where('id','=', $id)->delete();
            
            $doctors = Doctors::orderBy('_order')->get();
            return view('admin.pages.doctors.index', compact('doctors'));
        }
    }

    public function getAdd() {

        return view('admin.pages.doctors.add');
    }

    public function insertDoctor(Request $request)
    {
        $image = $request->input('image');
        $name = $request->input('name');
        $name_en = $request->input('name_en');
        $title = $request->input('title');
        $title_en = $request->input('title_en');
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $google = $request->input('google');
        $linkedin = $request->input('linkedin');
        $active = $request->input('active');
        $_order = $request->input('_order');
        
        $data = array(
            'image'=>$image,
            'name'=>$name,
            'name_en'=>$name_en,
            'title'=>$title,
            'title_en'=>$title_en,
            'facebook'=>$facebook,
            'twitter'=>$twitter,
            'google'=>$google,
            'linkedin'=>$linkedin,
            'active'=>$active,
            '_order'=>$_order
            );

        DB::table('doctors')->insert($data);
        
        $doctors = Doctors::orderBy('_order')->get();
        return view('admin.pages.doctors.index', compact('doctors'));
    }

    public function updatePackage(Request $request)
    {
        $id = $request->input('s_id');
        $image = $request->input('image');
        $name = $request->input('name');
        $name_en = $request->input('name_en');
        $title = $request->input('title');
        $title_en = $request->input('title_en');
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $google = $request->input('google');
        $linkedin = $request->input('linkedin');
        $active = $request->input('active');
        $_order = $request->input('_order');
        
        $data = array(
            'image'=>$image,
            'name'=>$name,
            'name_en'=>$name_en,
            'title'=>$title,
            'title_en'=>$title_en,
            'facebook'=>$facebook,
            'twitter'=>$twitter,
            'google'=>$google,
            'linkedin'=>$linkedin,
            'active'=>$active,
            '_order'=>$_order
            );

        DB::table('doctors')
            ->where('id','=', $id)
            ->update($data);

        $doctors = Doctors::orderBy('_order')->get();
        return view('admin.pages.doctors.index', compact('doctors'));
    }

}
