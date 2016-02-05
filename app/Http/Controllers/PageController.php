<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Request;
use App\Page;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    //
    /**
     *
     */
    public function index(){
        $page = Page::where('title','index')->get()->first();
        return view('pages.index')->with('page',$page);
    }

    public function credits(){
        //$credits = file_get_contents(__DIR__.'/credits.json');

        $page = Page::where('title','credits')->get()->first();
        return view('pages.index')->with('page',$page);
    }

    public function createPageForm(){
        return view('pages.admin.create');

    }
    public function createPage(){
        $input = Request::all();
        return Page::create($input);

    }

    public function updatePageForm($pageId){
        $page = Page::findOrFail($pageId);
        return view('pages.admin.edit')->with('page',$page);
    }
    public function updatePage($pageId){
        $page = Page::findOrFail($pageId);
        $page->title = Request::get('title');
        $page->body = Request::get('body');
        $page->admin_user_id = Request::get('admin_user_id');
        $page->update();
        return Redirect::to('/admin/page/'.$pageId);
    }
}
