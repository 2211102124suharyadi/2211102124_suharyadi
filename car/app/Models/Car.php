<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Car extends Model
{
    protected $fillable = ['merk_id', 'model', 'color', 'year', 'price', 'image'];
 
    public function merk()
    {
        return $this->belongsTo(Merk::class);
    }
}