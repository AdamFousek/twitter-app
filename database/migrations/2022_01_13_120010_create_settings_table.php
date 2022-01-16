<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 255)->unique();
            $table->text('value')->nullable(true);
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'consumer_key', 'value' => null],
            ['key' => 'consumer_secret', 'value' => null],
            ['key' => 'access_token', 'value' => null],
            ['key' => 'access_token_secret', 'value' => null],
            ['key' => 'bearer_token', 'value' => null],
            ['key' => 'result_limit', 'value' => 100],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
