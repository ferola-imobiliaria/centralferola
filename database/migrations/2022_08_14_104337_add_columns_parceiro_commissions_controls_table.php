<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsParceiroCommissionsControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commissions_controls', function (Blueprint $table) {
            $table->string('is_parceiro')->nullable();
            $table->string('nome_parceiro')->nullable();
            $table->string('cpf_cnpj_parceiro')->nullable();
            $table->string('telefone_parceiro')->nullable();
            $table->float('sale_value_parceiro', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commissions_controls', function (Blueprint $table) {
            $table->dropColumn('is_parceiro');
            $table->dropColumn('nome_parceiro');
            $table->dropColumn('cpf_cnpj_parceiro');
            $table->dropColumn('telefone_parceiro');
            $table->dropColumn('sale_value_parceiro');

        });
    }
}
