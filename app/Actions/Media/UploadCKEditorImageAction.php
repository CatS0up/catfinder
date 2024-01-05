<?php

declare(strict_types=1);

namespace App\Actions\Media;

use Illuminate\Http\UploadedFile;

class UploadCKEditorImageAction
{
    public function handle(UploadedFile $file): string
    {
        return $file->store('ckeditor', 'public');
    }
}
