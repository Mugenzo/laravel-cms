<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'media_id'
    ];

    /**
     * @return BelongsTo
     */
    public function preview(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
