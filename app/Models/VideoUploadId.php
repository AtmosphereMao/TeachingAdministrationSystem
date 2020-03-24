<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoUploadId extends Model
{
    protected $table = 'video_upload_id';

    protected $fillable = [
        'md5_code', 'file_original', 'upload_id'
    ];
}
