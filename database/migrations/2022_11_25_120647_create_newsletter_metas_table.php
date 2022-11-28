<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_metas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campaign_id');
            $table->string('categories_id',30);
            $table->integer('send_emails')->default(0);
            $table->string('total_emails',10)->nullable();
            $table->integer('click_amt')->default(0);
            $table->string('meta',255)->nullable();
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
        Schema::dropIfExists('newsletter_metas');
    }
};
