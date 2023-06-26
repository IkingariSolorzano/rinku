<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
    CREATE PROCEDURE updateEntregas(
        IN employeeId INT,
        IN mesT INT,
        IN cantidadEntregas INT
    )
    BEGIN
        DECLARE existQty INT;

        SELECT cantidad_entregas INTO existQty
        FROM movements
        WHERE employee_id = employeeId AND mes = mesT;

        IF existQty IS NOT NULL THEN
            UPDATE movements
            SET cantidad_entregas = existQty + cantidadEntregas
            WHERE employee_id = employeeId AND mes = mesT;
        ELSE
            INSERT INTO movements (employee_id, mes, cantidad_entregas)
            VALUES (employeeId, mesT, cantidadEntregas);
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
        DROP PROCEDURE IF EXISTS updateEntregas;
        EOT;

        DB::unprepared($query);
    }
};
