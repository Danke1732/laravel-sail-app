<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            // 購入価格
            $table->float('property_price', 255, 1)->nullable(false)->unsigned()->comment('物件価格');
            $table->float('purchase_fee', 255, 1)->nullable()->default(0)->unsigned()->comment('購入手数料');
            // 資金
            $table->float('borrowing_amount', 255, 1)->nullable()->default(0)->unsigned()->comment('借入金額');
            $table->float('annual_interest', 255, 1)->nullable()->default(0)->unsigned()->comment('年間利息');
            $table->float('borrowing_period', 255, 1)->nullable()->default(0)->unsigned()->comment('借入期間');
            // キャッシュフロー単年
            $table->float('monthly_rent_income', 255, 1)->nullable()->default(0)->unsigned()->comment('月家賃収入');
            $table->float('expense', 255, 1)->nullable()->default(0)->unsigned()->comment('経費率');
            $table->float('vacancy', 255, 1)->nullable()->default(0)->unsigned()->comment('空室率');
            $table->float('tax', 255, 1)->nullable()->default(0)->unsigned()->comment('税率');
            // キャッシュフロー累計
            $table->float('ownership_period', 255, 1)->nullable()->default(0)->unsigned()->comment('所有期間');
            $table->float('sale_price', 255, 1)->nullable()->default(0)->unsigned()->comment('売却価格');
            $table->float('sale_commission', 255, 1)->nullable()->default(0)->unsigned()->comment('売却手数料率');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charts');
    }
}
