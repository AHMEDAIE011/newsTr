<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function posts(){
        return $this->hasMany(Post::class,'category_id');  // Assuming Post model has a belongsTo relationship with Category
    }
    public function scopeActive($q){
        $q->where('status', 1);
    }
}
