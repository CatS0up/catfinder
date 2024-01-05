<?php

declare(strict_types=1);

use App\Actions\Guest\SendContactNotificationAction;
use App\DataObjects\ContactNotificationData;
use App\Exceptions\ContactNotificationException;
use App\Models\User;
use App\Notifications\Guest\ContactNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(SendContactNotificationAction::class);
});

it('throws ContactNotificationException when no admins are found in the system', function (): void {
    $this->actionUnderTest->handle(ContactNotificationData::from([
        'email' => 'test@test.com',
        'message' => 'lorem impsum...',
    ]));
})->throws(ContactNotificationException::class, 'No admins were found in system');

it('sends ContactNotification to all administrators', function (): void {
    // Given
    Notification::fake();
    Role::create(['name' => 'user']);
    Role::create(['name' => 'admin']);

    $admins = User::factory(2)->create()->each(function (User $user): void {
        $user->syncRoles('admin');
    });

    $users = User::factory(3)->create();

    // When
    $this->actionUnderTest->handle(ContactNotificationData::from([
        'email' => 'test@test.com',
        'message' => 'lorem impsum...',
    ]));

    // Then
    Notification::assertSentTo(
        notifiable: $admins,
        notification: ContactNotification::class,
        callback: fn (mixed $notification, array $channels): bool => in_array('mail', $channels),
    );

    Notification::assertNotSentTo(
        notifiable: $users,
        notification: ContactNotification::class,
        callback: fn (mixed $notification, array $channels): bool => in_array('mail', $channels),
    );
});
