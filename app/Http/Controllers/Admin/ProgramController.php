<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services;
use App\Packages;
use DB;

class ProgramController extends Controller {


    public function getIndex() {
        $programmes = DB::table('program')
                    ->join('packages', 'packages.id', '=', 'program.package')
                    ->select('program.*','packages.title')
                    ->get();

        return view('admin.pages.programmes.index', compact('programmes','packages'));
    }

    public function getProgram($id)
    {
        if (isset($id)) {
            $programmes = DB::table('program')
                    ->select('program.*')
                    ->where('id', '=', $id)
                    ->get();
            $packages = DB::table('packages')
                    ->select('packages.*')
                    ->get();

        return view('admin.pages.programmes.edit', compact('programmes','packages'));
        }
    }

    public function getPr($id)
    {
        if (isset($id)) {
        $programmes = DB::table('program')
                ->join('packages', 'packages.id', '=', 'program.package')
                ->select('program.*','packages.title')
                ->where('program.id', '=', $id)
                ->get();
        return view('admin.pages.programmes.delete', compact('programmes'));
        }
    }

    public function deletePr($id)
    {
        if (isset($id)) {
            DB::table('program')->where('id','=', $id)->delete();
            return back();
        }
    }

    public function getAdd() {

        $packages = DB::table('packages')
                    ->select('packages.*')
                    ->get();

        return view('admin.pages.programmes.add', compact('packages'));
    }

    public function insertProgram(Request $request)
    {
        $package = $request->input('package');
        $program_title = $request->input('program_title');
        $program_title_en = $request->input('program_title_en');
        $program_description = $request->input('program_description');
        $program_d_en = $request->input('program_d_en');
        $program_order = $request->input('program_order');

        $data = array(
            'package'=>$package,
            'name'=>$program_title,
            'name_en'=>$program_title_en,
            'content'=>$program_description,
            'content_en'=>$program_d_en,
            '_order'=>$program_order,
            );

        DB::table('program')->insert($data);
        return back();
    }

    public function updateProgram(Request $request)
    {
        $id = $request->input('s_id');
        $package = $request->input('package');
        $program_title = $request->input('program_title');
        $program_title_en = $request->input('program_title_en');
        $program_description = $request->input('program_description');
        $program_d_en = $request->input('program_d_en');
        $program_order = $request->input('program_order');

        $data = array(
            'package'=>$package,
            'name'=>$program_title,
            'name_en'=>$program_title_en,
            'content'=>$program_description,
            'content_en'=>$program_d_en,
            '_order'=>$program_order,
            );


        DB::table('program')
            ->where('id','=', $id)
            ->update($data);

        return back();
    }

}
