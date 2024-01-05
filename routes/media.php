<?php

declare(strict_types=1);

use App\Http\Controllers\Media\UploadCKEditorImageController;
use Illuminate\Support\Facades\Route;

Route::post('ckeditor/image-upload', UploadCKEditorImageController::class)
    ->name('ckeditor.imageUpload');
