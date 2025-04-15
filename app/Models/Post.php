<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory,Sluggable;
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function comments(){
        return $this->hasMany(Comment::class,'post_id');  // Assuming Post model has a belongsTo relationship with Category
    }
    public function images(){
        return $this->hasMany(Image::class,'post_id');  // Assuming Post model has a belongsTo relationship with Category
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function scopeActive($q){
        $q->where('status', 1);
    }

}
