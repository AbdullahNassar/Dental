<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stories;
use DB;

class StoriesController extends Controller {
    public function getIndex() {
        $stories = stories::orderBy('_order')->get();
        return view('admin.pages.stories.index', compact('stories'));
    }

    public function getStory($id)
    {
        if (isset($id)) {
        $stories = DB::table('stories')
            ->select('stories.*')
            ->where('id','=', $id)
            ->get();
        return view('admin.pages.stories.edit', compact('stories'));
        }
    }

    public function getS($id)
    {
        if (isset($id)) {
        $stories = DB::table('stories')
            ->select('stories.*')
            ->where('id','=', $id)
            ->get();
        return view('admin.pages.stories.delete', compact('stories'));
        }
    }

    public function deleteS($id)
    {
        if (isset($id)) {
            DB::table('stories')->where('id','=', $id)->delete();
            $stories = stories::orderBy('_order')->get();
        return view('admin.pages.stories.index', compact('stories'));
        }
    }

    public function updateStory(Request $request)
    {
        $id = $request->input('s_id');
        $name = $request->input('name');
        $name_en = $request->input('name_en');
        $title = $request->input('title');
        $title_en = $request->input('title_en');
        $story = $request->input('story');
        $story_en = $request->input('story_en');
        $image = $request->input('image');
        $active = $request->input('active');
        $_order = $request->input('_order');
        $data = array('name'=>$name,'name_en'=>$name_en,
            'title'=>$title,'title_en'=>$title_en,
            'story'=>$story,'story_en'=>$story_en,
            'image'=>$image,'_order'=>$_order,'active'=>$active);
        DB::table('stories')
            ->where('id','=', $id)
            ->update($data);

        $stories = stories::orderBy('_order')->get();
        return view('admin.pages.stories.index', compact('stories'));
    }

    public function getAdd() {
        return view('admin.pages.stories.add');
    }

    public function insertStory(Request $request)
    {
        $name = $request->input('name');
        $name_en = $request->input('name_en');
        $title = $request->input('title');
        $title_en = $request->input('title_en');
        $story = $request->input('story');
        $story_en = $request->input('story_en');
        $image = $request->input('image');
        $active = $request->input('active');
        $_order = $request->input('_order');
        $data = array('name'=>$name,'name_en'=>$name_en,
            'title'=>$title,'title_en'=>$title_en,
            'story'=>$story,'story_en'=>$story_en,
            'image'=>$image,'_order'=>$_order,'active'=>$active);

        DB::table('stories')->insert($data);

        $stories = stories::orderBy('_order')->get();
        return view('admin.pages.stories.index', compact('stories'));
    }

}
