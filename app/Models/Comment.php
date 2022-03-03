<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    //ATTR
    protected $table = 'comments';
    protected $fillable = ['name', 'email', 'content', 'measurement_id'];
    
    //RELATIONSHIP
    public function measurement() {
        return $this->belongsTo(Measurement::class, 'measurement_id', 'id');
    }
    
    //OTHER
    public function datePresenter() {
        return date('F Y', strtotime($this->created_at));
    }
}
