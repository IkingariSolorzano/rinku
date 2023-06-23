<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $query = <<<EOT
CREATE PROCEDURE updateMovementQuantity(IN movementId INT, IN cantidadEntregas INT)
BEGIN
    DECLARE existingQuantity INT;

    SELECT cantidad_entregas INTO existingQuantity
    FROM movements
    WHERE id = movementId;

    IF existingQuantity IS NOT NULL THEN
        UPDATE movements
        SET cantidad_entregas = existingQuantity + cantidadEntregas
        WHERE id = movementId;
    END IF;
END
EOT;

        DB::unprepared($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $query = <<<EOT
DROP PROCEDURE IF EXISTS updateMovementQuantity;
EOT;

        DB::unprepared($query);
    }
};
