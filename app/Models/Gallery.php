<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'gallery';
    public $timestamps = false;
    public function category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
