<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\post;

it('guest user cannot upload ckeditor image', function (): void {
    // Given
    $image = UploadedFile::fake()->image('test.jpg');

    // When & Then
    assertGuest();

    post('/ckeditor/image-upload', [
        'upload' => $image,
    ])
        ->assertRedirect('/login');

    assertGuest();
});

it('auth user can upload ckeditor image', function (): void {
    // Given
    Storage::fake('test');
    $image = UploadedFile::fake()->image('test.jpg');
    $user = User::factory()->create();

    // When & Then
    assertGuest();

    actingAs($user)
        ->post('/ckeditor/image-upload', [
            'upload' => $image,
        ])
        ->assertOk()
        ->assertJsonStructure(['url']);
});
