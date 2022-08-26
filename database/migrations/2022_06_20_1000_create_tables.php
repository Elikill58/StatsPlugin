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
        Schema::create('playerstats_games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->boolean('show_profile')->default(0);
            $table->boolean('stats_own_database')->default(0);
            $table->string('stats_host')->nullable();
            $table->unsignedInteger('stats_port')->nullable();
            $table->string('stats_username')->nullable();
            $table->string('stats_password')->nullable();
            $table->string('stats_database');
            $table->string('stats_table');
            $table->string('stats_unique_col');
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
        });

        Schema::create('playerstats_stats', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('settings')->nullable();
            $table->unsignedInteger('style')->default(1);
            $table->string('stats_column');
            $table->bigInteger('games_id')->unsigned();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
            
            $table->foreign('games_id')->references('id')->on('playerstats_games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playerstats_games');
        Schema::dropIfExists('playerstats_stats');
    }
};
