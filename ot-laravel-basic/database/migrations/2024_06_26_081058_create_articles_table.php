<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * migration을 실행시켰을 때 실행되는 코드가 들어있는 메소드
     */
    public function up(): void
    {
        // articles라는 테이블을 만든다.
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('body', 255);
            $table->foreignId('user_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * rollback 할 때 실행되는 메소드
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
