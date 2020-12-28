<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
			$table->id();
			$table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('excerpt')->nullable();
            $table->longText('body');
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT');
            $table->string('file')->nullable();

			$table->foreignId('category_id')
				->nullable()
                ->references('id')
				->on('categories');

            $table->morphs('author');

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
        Schema::dropIfExists('articles');
    }
}
