<?php

namespace App\Models;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id_FrKey', 'Post_id_FrKey'];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'Post_id_FrKey');
    }
}
