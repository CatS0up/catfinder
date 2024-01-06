<?php

declare(strict_types=1);

namespace App\Enums;

enum CatGender: string
{
    case Male = 'm';
    case Female = 'f';

    public function label(): string
    {
        return match ($this) {
            self::Male => __('Cat'),
            self::Female => __('Kitten'),
        };
    }
}
