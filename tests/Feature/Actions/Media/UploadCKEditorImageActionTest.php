<?php

declare(strict_types=1);

use App\Actions\Media\UploadCKEditorImageAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(UploadCKEditorImageAction::class);
});

it('should upload ckeditor image', function (): void {
    // Given
    Storage::fake('test');
    $image = UploadedFile::fake()->image('text.jpg');

    // When
    $path = $this->actionUnderTest->handle($image);

    // Then
    Storage::assertExists($path);
});
