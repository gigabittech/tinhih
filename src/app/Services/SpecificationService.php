<?php

namespace App\Services;

use App\Models\Admin\Specialization;

class SpecificationService
{
    public function getSpecializations()
    {
        return Specialization::all();
    }
}
