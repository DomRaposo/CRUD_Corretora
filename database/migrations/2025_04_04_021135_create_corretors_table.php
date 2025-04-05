<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('corretores', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->min(2);
            $table->string('cpf', 14)->unique();
            $table->string('creci')->min(2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('corretores');
    }
};
