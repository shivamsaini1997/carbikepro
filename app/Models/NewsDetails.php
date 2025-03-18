<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsDetails extends Model
{
    use HasFactory;
    protected $table = 'news_review_details';
    protected $primarykey = 'id';
}
