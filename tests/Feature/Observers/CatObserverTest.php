<?php

declare(strict_types=1);

use App\Models\Cat;

it('should clean the HTML content of the description when it is dirty', function (): void {
    // When
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
            <!DOCTYPE html>
                <html>
                    <head>
                        <title></title>
                    </head>
                    <body>
                        <h1>Welcome to My Website</h1>
                        <p>This is a paragraph with <b>bold</b> text.</p>
                        <img>
                    </body>
                </html>
        HTML;

    $cat = Cat::factory()->create([
        'description' => $dirtyHtml,
    ]);

    // Then
    $expected = preg_replace('/\s+/', ' ', trim($cleanHtml));
    $actual = preg_replace('/\s+/', ' ', trim($cat->description));

    expect($expected)->toBe($actual);
});
