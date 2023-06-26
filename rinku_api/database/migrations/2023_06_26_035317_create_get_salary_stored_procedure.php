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
    CREATE PROCEDURE calcular_salario(
        IN employeeId INT,
        IN mesT INT,
        OUT horas_base INT,
        OUT salario_base DECIMAL(10,2),
        OUT bono DECIMAL(10,2),
        OUT pago_entregas DECIMAL(10,2),
        OUT salario_bruto DECIMAL(10,2),
        OUT salario_neto DECIMAL(10,2),
        OUT pago_efectivo DECIMAL(10,2),
        OUT pago_vales DECIMAL(10,2)
    )
    BEGIN
        DECLARE roleT VARCHAR(20);
        DECLARE cantidad_entregas_e INT;

        -- Obtener el role del empleado
        SELECT role INTO roleT FROM employees WHERE id = employeeId;

        -- Obtener la cantidad de entregas del empleado en el mes especificado
        SELECT cantidad_entregas INTO cantidad_entregas_e
        FROM movements
        WHERE employee_id = employeeId AND mes  = mesT;

        -- Calcular las horas base, salario base, bono y pago de entregas
        SET horas_base = 8 * 6 * 4;
        SET salario_base = horas_base * 30;

        IF roleT = 'Chofer' THEN
            SET bono = horas_base * 10;
        ELSEIF roleT = 'Cargador' THEN
            SET bono = horas_base * 5;
        ELSEIF roleT = 'Auxiliar' THEN
            SET bono = horas_base * 0;
        END IF;

        SET pago_entregas = cantidad_entregas_e * 5;

        -- Calcular salario bruto
        SET salario_bruto = salario_base + bono + pago_entregas;

        -- Calcular salario neto
        IF salario_bruto <= 10000 THEN
            SET salario_neto = salario_bruto * 0.91;
        ELSE
            SET salario_neto = salario_bruto * 0.88;
        END IF;

        -- Calcular pago en efectivo y pago en vales
        SET pago_efectivo = salario_neto * 0.96;
        SET pago_vales = salario_neto * 0.04;
    END;

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
        Schema::dropIfExists('calcular_salario_stored_procedure');
    }
};
