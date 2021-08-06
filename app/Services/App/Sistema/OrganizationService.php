<?php

namespace App\Services\App\Sistema;


use App\Models\Organization;
use App\Services\App\AppService;

class OrganizationService extends AppService
{
    public function __construct(Organization $organization)
    {
        $this->model = $organization;
    }
}