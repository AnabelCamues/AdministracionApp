<?php

namespace App\Services\App\Sistema;

use App\Services\App\AppService;
use App\Models\Order;

class OrderService extends AppService
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }
}