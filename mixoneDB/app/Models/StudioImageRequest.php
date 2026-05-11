<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioImageRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'status',
        'admin_comment'
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
