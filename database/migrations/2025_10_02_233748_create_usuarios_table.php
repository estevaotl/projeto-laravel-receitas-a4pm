<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
//     CREATE TABLE IF NOT EXISTS `teste_receitas_rg_sistemas`.`usuarios` (
//   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '\n',
//   `nome` VARCHAR(100) NULL,
//   `login` VARCHAR(100) NOT NULL,
//   `senha` VARCHAR(100) NOT NULL,
//   `criado_em` DATETIME NOT NULL,
//   `alterado_em` DATETIME NOT NULL,
//   PRIMARY KEY (`id`),
//   UNIQUE INDEX `login_UNIQUE` (`login` ASC))
// ENGINE = InnoDB;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->nullable();
            $table->string('login', 100)->unique();
            $table->string('senha', 100);
            $table->dateTime('criado_em');
            $table->dateTime('alterado_em');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
