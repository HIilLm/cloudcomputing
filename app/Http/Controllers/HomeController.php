<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing()
    {
        return view("frontend.allpost",[
            "news" => News::all()
        ]);
    }

    public function single(News $news)
    {
        $komen = News::find($news->id);
        return view("frontend.singlepost",[
            "new" => $news,
            "comments" => $komen->comments,
            "replies" => function($id){
                return Comment::where("id_comment", $id)->get();
            }
        ]);
    }
}
