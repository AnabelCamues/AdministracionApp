<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Traits\ProductRelationship;

class Product extends Model
{
    use HasFactory, ProductRelationship;
    protected $table = 'products';
    protected $guarded = [];

    protected $with = [
        'organization'
    ];
}
