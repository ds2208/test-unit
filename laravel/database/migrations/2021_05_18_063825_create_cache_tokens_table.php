<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCacheTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cache_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token',50);
            $table->string('pagination_token',50)->nullable();
        });

        Schema::create('cache_token_entities', function (Blueprint $table) {
            $table->id();
            $table->integer('cache_token_id');
            $table->string('entity_table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cache_tokens');
        Schema::dropIfExists('cache_token_entities');
    }
}
