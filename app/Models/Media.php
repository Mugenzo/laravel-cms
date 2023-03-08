<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $filename
 * @property string $title
 * @property string $alt
 * @property string $mime_type
 */
class Media extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'media';

    const RESIZABLE_MEDIA_TYPES = [
        "image/jpeg", "image/png", "image/gif", "image/bmp", "image/webp"
    ];
    protected $fillable = [
        'filename',
        'title',
        'alt',
        'mime_type'
    ];

    public function getImageSize(string $size = 'full'): string
    {
        if (!in_array($this->mime_type, self::RESIZABLE_MEDIA_TYPES)) {
            return "/storage/defaults/files.png";
        }

        $sizes = config('cms.image_sizes');
        if (array_key_exists($size, $sizes)) {
            $sizesExtensions = "-{$sizes[$size][0]}x{$sizes[$size][1]}";
            $filePath = storage_path('app/public/uploads/' . $this->filename);

            $fileBaseName = pathinfo($filePath, PATHINFO_FILENAME);
            $fileBaseExtension = pathinfo($filePath, PATHINFO_EXTENSION);


            if (Storage::disk('public')->exists("uploads/{$fileBaseName}{$sizesExtensions}.{$fileBaseExtension}")) {
                return "/storage/uploads/{$fileBaseName}{$sizesExtensions}.{$fileBaseExtension}";
            }
        }

        return "/storage/uploads/$this->filename";
    }
}
