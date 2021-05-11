<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $table = 'ads';
    protected $fillable = [
        'file_name',
        'file_path',
        'link',
        'location',
    ];
}
