<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable=['title','user_id','subject_id','category_id','description','price','slug','code','year','status'];
}
