<?php

declare(strict_types=1);

use App\Exceptions\ContactNotificationException;
use App\Models\User;
use App\Notifications\Guest\ContactNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\withoutExceptionHandling;

it('auth user cannot display contact page', function (): void {
    // Given
    $user = User::factory()->create();

    // When & Then
    actingAs($user)
        ->get('/contact')
        ->assertRedirect(RouteServiceProvider::HOME);
});

it('guest user can display contact page', function (): void {
    // When & Then
    get('/contact')
        ->assertOk()
        ->assertViewIs('guest.contact');
});

it('auth user cannot send ContactNotification', function (): void {
    // Given
    $user = User::factory()->create();

    // When & Then
    actingAs($user)
        ->post('/contact', [
            'email' => 'example@example.com',
            'message' => 'Lorem ipsum...',
        ])
        ->assertRedirect(RouteServiceProvider::HOME);
});

it('should redirect back with a warning when a guest tries to send a ContactNotification, but there are no admins in the system', function (): void {
    // Given
    withoutExceptionHandling();

    // When & Then
    post('/contact', [
        'email' => 'example@example.com',
        'message' => 'Lorem ipsum...',
    ])
        ->assertRedirect('/contact')
        ->assertSessionHas('warning', __('An unknown error occurred while sending the message, please try again later'))
        ->assertSeeText(__('An unknown error occurred while sending the message, please try again later'));
})->throws(ContactNotificationException::class);

it('guest can send ContactNotification to admins and redirect user back when system has admins', function (): void {
    // Given
    Notification::fake();
    Role::create(['name' => 'admin']);
    $admins = User::factory(3)->create();

    foreach ($admins as $admin) {
        $admin->syncRoles('admin');
    }

    // When & Then
    post('/contact', [
        'email' => 'example@example.com',
        'message' => 'Lorem ipsum...',
    ])
        ->assertSessionHas('info', __('Your message has been sent'));

    Notification::assertSentTo(
        notifiable: $admins,
        notification: ContactNotification::class,
        callback: fn (mixed $notification, array $channels): bool => in_array('mail', $channels),
    );
});
