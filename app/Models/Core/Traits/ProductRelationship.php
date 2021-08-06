<?php

namespace App\Models\Core\Traits;

use App\Models\Organization;


trait ProductRelationship
{
    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }
}
