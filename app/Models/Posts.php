<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
   
    

    protected $fillable = [
        'Title',
        'Editor_Id',
        'Description',
        'Expire_Date',
        'likes_count',
        'media_path',
        'Approval_Letter',
        'Society_Id',
        'Dep_Id',
        'Faculty_Id'
    ];

    public function users()
    {
         return $this->belongsToMany(User::class);
    }
}
