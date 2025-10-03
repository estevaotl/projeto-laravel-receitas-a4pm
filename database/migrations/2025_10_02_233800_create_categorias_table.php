<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

//     CREATE TABLE IF NOT EXISTS `teste_receitas_rg_sistemas`.`categorias` (
//   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
//   `nome` VARCHAR(100) NULL,
//   PRIMARY KEY (`id`),
//   UNIQUE INDEX `nome_UNIQUE` (`nome` ASC))
// ENGINE = InnoDB
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
