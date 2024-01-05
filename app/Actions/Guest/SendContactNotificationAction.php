<?php

declare(strict_types=1);

namespace App\Actions\Guest;

use App\DataObjects\ContactNotificationData;
use App\Exceptions\ContactNotificationException;
use App\Models\User;
use App\Notifications\Guest\ContactNotification;
use Illuminate\Support\Facades\Notification;

final class SendContactNotificationAction
{
    public function __construct(private User $user)
    {

    }

    public function handle(ContactNotificationData $data): void
    {
        $admins = $this->user->query()
            ->whereRelation('roles', 'name', 'admin')
            ->get();

        if ($admins->isEmpty()) {
            throw ContactNotificationException::adminsNotFound();
        }

        Notification::send($admins, new ContactNotification($data));
    }
}
