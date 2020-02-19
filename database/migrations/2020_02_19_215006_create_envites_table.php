<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id');
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->foreign('empresa_id')
                    ->references('id')
                    ->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envites');
    }
}
