<?php

declare(strict_types=1);

namespace App\Http\Controllers\Media;

use App\Actions\Media\UploadCKEditorImageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\UploadCKEditorImageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Filesystem\FilesystemManager as FileManager;
use Symfony\Component\HttpFoundation\Response;

class UploadCKEditorImageController extends Controller
{
    public function __invoke(UploadCKEditorImageRequest $request, FileManager $fileManager, UploadCKEditorImageAction $action): JsonResponse
    {
        $path = $action->handle($request->upload);

        if ( ! $path) {
            return response()->json(
                [
                    'message' => 'UploadCKEditor failed',
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json([
            'url' => $fileManager->url($path),
        ]);
    }
}
