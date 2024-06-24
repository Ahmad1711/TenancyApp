<?php

namespace App\Models;

use App\Traits\BelongToStore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // use BelongToStore;

    protected $connection='tenant';

    public function store(){

        return $this->belongsTo(Store::class);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }
}
