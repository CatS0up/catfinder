<?php

declare(strict_types=1);

namespace App\Enums;

enum CatStatus: string
{
    case Available = 'available';
    case Adopted = 'adopted';
    case ForApproval = 'for_approval';
}
