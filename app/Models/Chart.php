<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;

    /**
     * 計算表に結びつくオプション情報を取得
     */
    public function option()
    {
        return $this->hasOne(Option::class);
    }
    
    /**
     * 計算表に結びつく複数の画像を取得
     */
    public function chart_image()
    {
        return $this->hasMany(ChartImage::class);
    }

    protected $table = "charts";
    protected $fillable = [
        // 購入価格
        'property_price',
        'purchase_fee',
        // 資金
        'borrowing_amount',
        'annual_interest',
        'borrowing_period',
        // キャッシュフロー単年
        'monthly_rent_income',
        'expense',
        'vacancy',
        'tax',
        // キャッシュフロー累計
        'ownership_period',
        'sale_price',
        'sale_commission',
        // リレーション
        'user_id',
    ];
}
