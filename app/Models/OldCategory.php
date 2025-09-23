<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldCategory extends Model
{
    // الجدول القديم
    protected $table = 'oldcategories';

    protected $primaryKey = 'cid';


    public $timestamps = false;

    protected $fillable = [
        'cid', 'title', 'content', 'guide', 'img', 'meta_keywords', 'meta_description',
        'published_at', 'created_by', 'modified_at', 'views', 'status', 'sections', 'created_at'
    ];
}
