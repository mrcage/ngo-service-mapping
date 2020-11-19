<?php

namespace App\Actions;

use App\Models\Organization;
use App\Models\Sector;

class UpdateOrganization
{
    public function update(Organization $organization, array $data, array $sectors)
    {
        $organization->fill($data);
        $organization->type()->associate($data['type_id']);
        $organization->save();
        $organization->sectors()->sync(Sector::whereIn('slug', $sectors)->get());
    }
}
