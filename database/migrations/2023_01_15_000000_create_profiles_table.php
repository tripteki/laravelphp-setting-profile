<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create("environments", function (Blueprint $table) {

            $table->char("variable", 255);
            $table->text("value");

            $table->primary("variable");
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("environments");
    }
};
