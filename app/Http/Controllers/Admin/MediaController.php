<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Media\StoreRequest;
use App\Http\Requests\Admin\Media\UpdateRequest;
use App\Http\Resources\Admin\MediaResource;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return MediaResource::collection(
            Media::query()
                ->orderBy('created_at', 'desc')
                ->paginate($request->has('per-page') ? $request->get('per-page') : setting('per-page'))
        );
    }

    /**
     * @param StoreRequest $storeRequest
     * @return JsonResponse
     */
    public function store(StoreRequest $storeRequest): JsonResponse
    {
        try {
            $file = $storeRequest->file('file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $originalExtension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

            $storageName = "{$originalName}.{$originalExtension}";
            if (Storage::disk('public')->exists('uploads/' . $storageName)) {
                $i = 1;
                do {
                    $storageName = "{$originalName}-{$i}.{$originalExtension}";
                    $i++;
                } while (Storage::disk('public')->exists('uploads/' . $storageName));
            }

            $file->storeAs('public/uploads', $storageName);
            Media::create([
                'filename' => $storageName,
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'mime_type' => $file->getClientMimeType()
            ]);

            return response()->json(['message' => __('admin.media.store.success')]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('admin.media.store.error'),
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @param Media $media
     * @return MediaResource
     */
    public function show(Media $media): MediaResource
    {
        return MediaResource::make($media);
    }

    /**
     * @param UpdateRequest $updateRequest
     * @param Media $media
     * @return JsonResponse
     */
    public function update(UpdateRequest $updateRequest, Media $media): JsonResponse
    {
        try {
            $media->update($updateRequest->all());

            return response()->json(['message' => __('admin.media.update.success')]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('admin.media.update.error'),
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @param Media $media
     * @return JsonResponse
     */
    public function destroy(Media $media): JsonResponse
    {
        try {
            $media->delete();

            return response()->json(['message' => __('admin.media.delete.success')]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('admin.media.delete.error'),
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
