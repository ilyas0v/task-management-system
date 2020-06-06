<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPointAndCommentFieldsToTaskCompletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_completes', function (Blueprint $table) {
            $table->integer('point')->nullable();
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_completes', function (Blueprint $table) {
            $table->dropColumn('point');
            $table->dropColumn('comment');
        });
    }
}
