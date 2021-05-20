<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartImage extends Model
{
    use HasFactory;

    /**
     * 計算画像に結びつく計算表を取得
     */
    public function chart()
    {
        return $this->belongsTo(Chart::class);
    }

    protected $table = "chart_images";
    protected $fillable = [
        'image_name',
        'image_path',
        'chart_id',
    ];
}
