<?php

declare(strict_types=1);

use App\Models\Cat;

it('should clean the HTML content of the description during create', function (): void {
    // Given
    $dirtyHtml = <<<HTML
        <!DOCTYPE html>
            <html>
                <head>
                    <title><script>alert('XSS Attack');</script></title>
                </head>
                <body>
                    <h1>Welcome to My Website</h1>
                    <p>This is a paragraph with <b>bold</b> text.</p>
                    <img src="javascript:alert('XSS');">
                </body>
            </html>
        HTML;

    $cleanHtml = <<<HTML
            <h1>Welcome to My Website</h1>
            <p>This is a paragraph with <b>bold</b> text.</p>
        HTML;

    // When
    $cat = Cat::factory()->create([
        'description' => $dirtyHtml,
    ]);

    // Then
    expect($cleanHtml)->toBeHtml($cat->description);
});

it('should clean the HTML content of the description during update', function (): void {
    // Given
    $dirtyHtml = <<<HTML
        <!DOCTYPE html>
            <html>
                <head>
                    <title><script>alert('XSS Attack');</script></title>
                </head>
                <body>
                    <h1>Welcome to My Website</h1>
                    <p>This is a paragraph with <b>bold</b> text.</p>
                    <img src="javascript:alert('XSS');">
                </body>
            </html>
        HTML;

    $cleanHtml = <<<HTML
            <h1>Welcome to My Website</h1>
            <p>This is a paragraph with <b>bold</b> text.</p>
        HTML;

    $cat = Cat::factory()->create();

    // When & Then
    expect($dirtyHtml)->not->toBeHtml($cat->description);

    $cat->update(['description' => $dirtyHtml]);

    expect($cleanHtml)->toBeHtml($cat->description);
});
