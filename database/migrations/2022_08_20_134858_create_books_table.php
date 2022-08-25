<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("books", function (Blueprint $table) {
            $table->id();
            $table->string("collection_code")->nullable();
            $table->string("collection_title")->nullable();
            $table->string("author")->nullable();
            $table->string("publisher")->nullable();
            $table->integer("stock")->nullable();
            $table->integer("current_stock")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists("books");
    }
};
