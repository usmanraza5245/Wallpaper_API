<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    public $timestamps = false;
    public function gallery(){
        return $this->hasMany(Gallery::class,'cat_id');
    }
}
