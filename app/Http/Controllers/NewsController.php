<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.news.index',[
            "news" => News::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $validated = $request->validate([
            "title" => "required",
            "cover_image" => "image|file|required",
            "body" => "min:5|required"
        ]);
        $validated['title'] = $title;
        $validated['cover_image'] = $request->file('cover_image')->store('news-image', ['disk' => 'public']);
        $news = News::create($validated);
        $news::find($news->id)->update(['slug' => self::slugify(strip_tags($title ."-". strval($news->id) ))]);
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('dashboard.news.show',[
            "new" => $news
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('dashboard.news.edit',[
            "news" => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $title = $request->title;
        $validated = $request->validate([
            "title" => "required",
            "cover_image" => "image|file",
            "body" => "min:5|required"
        ]);
        $validated['title'] = $title;
        $validated['slug'] = self::slugify(strip_tags($title ."-". strval($news->id) ));
        if ($request->hasFile('cover_image')) {
            Storage::disk('public')->delete($news->cover_image);
            $validated['cover_image'] =  $request->file('cover_image')->store('news-image', ['disk' => 'public']);
        }
        News::find($news->id)->update($validated);
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        Storage::disk('public')->delete($news->cover_image);
        News::destroy($news->id);
        return redirect()->back();
    }

    public function comment(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "message" => "required",
            "news_id" => "required"
        ]);
        Comment::create($validated);
        return redirect()->back();
    }

    public function balas(Request $request,$id)
    {
       $validated = $request->validate([
        "message" => "required",
        "news_id" => "required",
       ]);
       $validated["name"] = "Admin";
       $validated["id_comment"] = $id;
       Comment::create($validated);
       return redirect()->back();
    }

    public function hapus(Comment $comment)
    {
        Comment::destroy($comment->id);
        return redirect()->back();
    }
}
