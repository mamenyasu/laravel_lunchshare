<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    protected $fillable =[
        'user_id',
        'user_name',
        'shop_name',
        'comment',
        'pref_city',
        'image_path',
        'delete_pass',
        ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
