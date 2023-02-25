<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTreesTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('trees', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedInteger('quantity_fruits');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('trees');
    }
}
