<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'location', 'email', 'website', 'company', 'tags', 'description', 'user_id'];

    public function image(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function scopeFilter($query, array $filters){
        if($filters['tag'] ?? false){
            $query->where('tags' , 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false){
            $query->where('tags' , 'like', '%' . request('search') . '%')
            ->orWhere('title' , 'like', '%' . request('search') . '%')
            ->orWhere('description' , 'like', '%' . request('search') . '%');
        }
    }
}
