<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $guarded = ["id"];
    
    public function news()
    {
        return $this->belongsTo(News::class,'news_id','id');
    }
}
