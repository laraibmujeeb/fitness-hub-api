<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUserFieldsNullable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Making the fields nullable
            $table->float('height')->nullable()->change();
            $table->float('weight')->nullable()->change();
            $table->string('goal')->nullable()->change();
            $table->string('subgoal')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the changes
            $table->float('height')->nullable(false)->change();
            $table->float('weight')->nullable(false)->change();
            $table->string('goal')->nullable(false)->change();
            $table->string('subgoal')->nullable(false)->change();
        });
    }
}
