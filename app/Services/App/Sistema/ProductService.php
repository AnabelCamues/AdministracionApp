<?php

namespace App\Services\App\Sistema;

use App\Services\App\AppService;
use App\Models\Product;

class ProductService extends AppService
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }
}