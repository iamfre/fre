<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateHarvestersTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('harvesters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('capacity')->default(10000);
            $table->boolean('at_work')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('harvesters');
    }
}
