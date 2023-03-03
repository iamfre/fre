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
            $table->string('type');
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('capacity')->default(10000);
            $table->string('status');
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
