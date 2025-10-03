<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    //     CREATE TABLE IF NOT EXISTS `teste_receitas_rg_sistemas`.`receitas` (
    //   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    //   `id_usuarios` INT(10) UNSIGNED NOT NULL,
    //   `id_categorias` INT(10) UNSIGNED NULL,
    //   `nome` VARCHAR(45) NULL,
    //   `tempo_preparo_minutos` INT UNSIGNED NULL,
    //   `porcoes` INT UNSIGNED NULL,
    //   `modo_preparo` TEXT NOT NULL,
    //   `ingredientes` TEXT NULL,
    //   `criado_em` DATETIME NOT NULL,
    //   `alterado_em` DATETIME NOT NULL,
    //   PRIMARY KEY (`id`),
    //   INDEX `fk_receitas_1_idx` (`id_usuarios` ASC),
    //   INDEX `fk_receitas_2_idx` (`id_categorias` ASC),
    //   CONSTRAINT `fk_receitas_1`
    //     FOREIGN KEY (`id_usuarios`)
    //     REFERENCES `teste_receitas_rg_sistemas`.`usuarios` (`id`)
    //     ON DELETE RESTRICT
    //     ON UPDATE CASCADE,
    //   CONSTRAINT `fk_receitas_2`
    //     FOREIGN KEY (`id_categorias`)
    //     REFERENCES `teste_receitas_rg_sistemas`.`categorias` (`id`)
    //     ON DELETE CASCADE
    //     ON UPDATE CASCADE)
    // ENGINE = InnoDB;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuarios');
            $table->unsignedBigInteger('id_categorias')->nullable();
            $table->string('nome', 45)->nullable();
            $table->unsignedInteger('tempo_preparo_minutos')->nullable();
            $table->unsignedInteger('porcoes')->nullable();
            $table->text('modo_preparo');
            $table->text('ingredientes')->nullable();
            $table->dateTime('criado_em');
            $table->dateTime('alterado_em');

            // Índices
            $table->index('id_usuarios', 'fk_receitas_1_idx');
            $table->index('id_categorias', 'fk_receitas_2_idx');

            // Chaves estrangeiras
            $table->foreign('id_usuarios', 'fk_receitas_1')
                ->references('id')
                ->on('usuarios')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_categorias', 'fk_receitas_2')
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receitas');
    }
};
