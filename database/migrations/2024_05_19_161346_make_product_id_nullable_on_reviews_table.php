<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeProductIdNullableOnReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('product_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('product_id')->nullable(false)->change();
        });
    }
}
