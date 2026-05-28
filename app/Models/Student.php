<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Translation\Loader\FileLoader;

class Student extends Model
{
    //
    protected $fillable = 
    [
        "fname",
        "mname",
        "lname",
        "email",
        "contactno",
        "degree_id"
    ];

    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }
}
