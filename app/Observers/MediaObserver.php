<?php

namespace App\Observers;

use App\Models\Media;
use Intervention\Image\Facades\Image;


class MediaObserver
{
    /**
     * Handle the Media "created" event.
     */
    public function created(Media $media): void
    {
        if (!in_array($media->mime_type, Media::RESIZABLE_MEDIA_TYPES)) {
            return;
        }

        $file = storage_path('app/public/uploads/' . $media->filename);
        $fileBaseName = pathinfo($file, PATHINFO_FILENAME);
        $fileBaseExtension = pathinfo($file, PATHINFO_EXTENSION);

        foreach (config('cms.image_sizes') as $size):
            $interventionImage = Image::make($file);
            if ($interventionImage->width() < $size[0] && $interventionImage->height() < $size[1]) continue;

            $interventionImage->fit($size[0], $size[1], function ($constraint) {
                $constraint->upsize();
            })->save(storage_path("app/public/uploads/{$fileBaseName}-{$size[0]}x{$size[1]}.{$fileBaseExtension}"));
        endforeach;
    }

    /**
     * Handle the Media "updated" event.
     */
    public function updated(Media $media): void
    {
        //
    }

    /**
     * Handle the Media "deleted" event.
     */
    public function deleted(Media $media): void
    {
        //
    }

    /**
     * Handle the Media "restored" event.
     */
    public function restored(Media $media): void
    {
        //
    }

    /**
     * Handle the Media "force deleted" event.
     */
    public function forceDeleted(Media $media): void
    {
        //
    }
}
