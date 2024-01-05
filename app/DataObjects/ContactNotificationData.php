<?php

declare(strict_types=1);

namespace App\DataObjects;

use Spatie\LaravelData\Data;

final class ContactNotificationData extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $message,
    ) {
    }
}
