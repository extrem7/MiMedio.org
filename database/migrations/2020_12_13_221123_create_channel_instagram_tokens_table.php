<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelInstagramTokensTable extends Migration
{
    public function up(): void
    {
        Schema::create('channel_instagram_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('channel_id')->unique()->primary();
            $table->string('token');
            $table->timestamp('expires_at');

            $table->foreign('channel_id')
                ->references('id')
                ->on('channels')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('channel_instagram_tokens');
    }
}
