<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {

        // 一回限り
        // Schema::create('attendances', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID（外部キー）
        //     $table->timestamp('clock_in')->nullable();  // 出勤時間
        //     $table->timestamp('clock_out')->nullable(); // 退勤時間
        //     $table->date('date');  // 日付
        //     $table->timestamps();
        // });

        // 何回でも
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('type'); // 出勤か退勤か
            $table->date('date');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}


