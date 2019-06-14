<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class GalleryController extends Controller {

    public function getIndex() {

        $images = DB::table('gallery')
            ->join('categories', 'categories.id', '=', 'gallery.category_id')
            ->select('gallery.*','categories.name')
            ->get();

        return view('admin.pages.gallery.index', compact('images'));
    }

    public function getGallery($id)
    {
        if (isset($id)) {
        $images = DB::table('gallery')
            ->join('categories', 'categories.id', '=', 'gallery.category_id')
            ->select('gallery.*','categories.name')
            ->where('gallery.id','=', $id)
            ->get();
        $categories = DB::table('categories')
            ->select('categories.*')
            ->get();
        return view('admin.pages.gallery.edit', compact('images','categories'));
        }
    }

    public function getG($id)
    {
        if (isset($id)) {
        $images = DB::table('gallery')
            ->join('categories', 'categories.id', '=', 'gallery.category_id')
            ->select('gallery.*','categories.name')
            ->where('gallery.id','=', $id)
            ->get();
        $categories = DB::table('categories')
            ->select('categories.*')
            ->get();
        return view('admin.pages.gallery.delete', compact('images','categories'));
        }
    }

    public function deleteG($id)
    {
        if (isset($id)) {
            DB::table('gallery')->where('id','=', $id)->delete();
            $images = DB::table('gallery')
            ->join('categories', 'categories.id', '=', 'gallery.category_id')
            ->select('gallery.*','categories.name')
            ->get();
        return view('admin.pages.gallery.index', compact('images'));
        }
    }

    public function updateGallery(Request $request)
    {
        $id = $request->input('s_id');
        $image = $request->input('image');
        $category = $request->input('category');
        $data = array('image'=>$image,'category_id'=>$category);

        DB::table('gallery')
            ->where('id','=', $id)
            ->update($data);

        $images = DB::table('gallery')
            ->join('categories', 'categories.id', '=', 'gallery.category_id')
            ->select('gallery.*','categories.name')
            ->get();
        return view('admin.pages.gallery.index', compact('images'));
    }

    public function getAdd() {

        $categories = DB::table('categories')
            ->select('categories.*')
            ->get();

        return view('admin.pages.gallery.add', compact('categories'));
    }

    public function insertImage(Request $request)
    {

        $image = $request->input('image');
        $category = $request->input('category');
        $data = array('image'=>$image,'category_id'=>$category);

        DB::table('gallery')->insert($data);

        $images = DB::table('gallery')
            ->join('categories', 'categories.id', '=', 'gallery.category_id')
            ->select('gallery.*','categories.name')
            ->get();
        return view('admin.pages.gallery.index', compact('images'));
    }

}
