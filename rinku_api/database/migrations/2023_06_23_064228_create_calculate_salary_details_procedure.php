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
CREATE PROCEDURE calculateSalaryDetails(IN employeeId INT)
BEGIN
    DECLARE totalSalary INT;
    DECLARE retention DECIMAL(10, 2);
    DECLARE finalSalary DECIMAL(10, 2);

    SELECT calculateTotalSalary(employeeId) INTO totalSalary;

    IF totalSalary < 10000 THEN
        SET retention = totalSalary * 0.09;
    ELSE
        SET retention = totalSalary * 0.12;
    END IF;

    SET finalSalary = totalSalary - retention;

    SELECT totalSalary, retention, finalSalary;
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
DROP PROCEDURE IF EXISTS calculateSalaryDetails;
EOT;

        DB::unprepared($query);
    }
};
