<?php

use App\Models\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');

            $table->string('title');
            $table->text('excerpt');
            $table->text('body');
            $table->string('slug')->unique();

            $table->unsignedBigInteger('views')->default(0);

            $table->enum('status', [Post::$statuses])->default(Post::DRAFT);

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
}
