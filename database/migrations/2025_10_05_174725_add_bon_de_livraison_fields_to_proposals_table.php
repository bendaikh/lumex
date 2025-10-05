<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            if(!Schema::hasColumn('proposals', 'is_convert_bon_de_livraison'))
            {
                $table->integer('is_convert_bon_de_livraison')->default('0')->after('converted_invoice_id');
            }
            if(!Schema::hasColumn('proposals', 'converted_bon_de_livraison_id'))
            {
                $table->integer('converted_bon_de_livraison_id')->default('0')->after('is_convert_bon_de_livraison');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            if(Schema::hasColumn('proposals', 'is_convert_bon_de_livraison'))
            {
                $table->dropColumn('is_convert_bon_de_livraison');
            }
            if(Schema::hasColumn('proposals', 'converted_bon_de_livraison_id'))
            {
                $table->dropColumn('converted_bon_de_livraison_id');
            }
        });
    }
};
