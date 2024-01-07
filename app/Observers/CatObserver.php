<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Cat;
use Stevebauman\Purify\Facades\Purify;

class CatObserver
{
    public function saving(Cat $cat): void
    {
        if ($cat->isDirty('description')) {
            /** @var string */
            $cleanHtml = Purify::clean($cat->description);
            $cat->description = $cleanHtml;
        }
    }
}
