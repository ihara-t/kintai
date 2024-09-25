<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAttendancesTableAddDefaultDate extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // dateカラムにデフォルト値としてCURRENT_DATEを設定
            $table->date('date')->default(DB::raw('CURRENT_DATE'))->change();
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // 元に戻す
            $table->date('date')->nullable(false)->change();
        });
    }
}

class UpdateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // 出勤か退勤かを区別するカラム
            $table->string('type');
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
