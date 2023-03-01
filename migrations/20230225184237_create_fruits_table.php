<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateFruitsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('fruits', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->unsignedBigInteger('weight')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('fruits');
    }
}
