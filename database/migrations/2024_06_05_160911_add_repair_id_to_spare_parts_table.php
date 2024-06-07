<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepairIdToSparePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spare_parts', function (Blueprint $table) {
            $table->unsignedBigInteger('repair_id')->after('id');

            // Assuming repairs table already exists and repair_id is a foreign key
            $table->foreign('repair_id')->references('id')->on('repairs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spare_parts', function (Blueprint $table) {
            $table->dropForeign(['repair_id']);
            $table->dropColumn('repair_id');
        });
    }
}
