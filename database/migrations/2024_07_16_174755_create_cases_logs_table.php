<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesLogsTable extends Migration
{
    public function up()
    {
        Schema::create('cases_logs', function (Blueprint $table) {
            $table->id();
            $table->string('student_id',11);
            $table->foreignId('cases_id')->constrain('')->onDelete('cascade');
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('student_profilings')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('cases_logs');
    }
}

