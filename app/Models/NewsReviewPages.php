<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsReviewPages extends Model
{
    use HasFactory;
    protected $table = 'news_reviews_pages';
    protected $primarykey = 'id';
}
