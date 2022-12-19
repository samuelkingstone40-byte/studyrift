<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->string('title')->index()->change();
            $table->string('slug')->index()->change();
             $table->integer('subject_id')->index()->change();
            $table->integer('category_id')->index()->change();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
           // $table->dropIndex(['subject_id','category_id','slug','title']);
        });
    }
}
