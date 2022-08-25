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
        Schema::create("student_books", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("student_id")->nullable();
            $table
                ->foreign("student_id")
                ->references("id")
                ->on("students")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->unsignedBigInteger("book_id")->nullable();
            $table
                ->foreign("book_id")
                ->references("id")
                ->on("books")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->integer("receipt_number")->nullable();
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
        Schema::dropIfExists("student_books");
    }
};
