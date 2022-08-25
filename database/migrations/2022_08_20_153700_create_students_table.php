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
        Schema::create("students", function (Blueprint $table) {
            $table->id();
            $table->string("receipt_number")->nullable();
            $table->string("student_number")->nullable();
            $table->string("name")->nullable();
            $table->string("class")->nullable();
            $table->timestamp("borrow_date")->nullable();
            $table->timestamp("return_date")->nullable();
            $table
                ->integer("borrow_status")
                ->default(0)
                ->comment("0 : sedang dipinjam, 1 : sudah kembali");
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
        Schema::dropIfExists("students");
    }
};
