<?php

declare(strict_types=1);

namespace App\ViewModels\User\Cat;

use App\DataObjects\CatData;
use App\Models\Cat;
use App\ViewModels\BaseViewModel;

class UpdateCatViewModel extends BaseViewModel
{
    public function __construct(private readonly Cat $cat)
    {
    }

    public function cat(): CatData
    {
        return $this->cat->getData();
    }
}
