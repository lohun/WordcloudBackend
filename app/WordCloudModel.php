<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WordCloudModel extends Model
{
    //
    protected $fillable = [
        "title",
        "words",
        "colours",
        "background",
        "filename",
        "mime",
        "original_filename",
        "created_at",
        "updated_at"
    ];
}
