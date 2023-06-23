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
CREATE PROCEDURE calculateSalary(IN employeeId INT)
BEGIN
    DECLARE hoursWorked INT;
    DECLARE baseSalary INT;
    DECLARE bonus INT;
    DECLARE grossSalary INT;

    SELECT (8 * 6 * 4) INTO hoursWorked;

    SELECT hoursWorked * 30 INTO baseSalary;

    SELECT IF(role = 'Chofer', hoursWorked * 10, hoursWorked * 5) INTO bonus
    FROM employees
    WHERE id = employeeId;

    SET grossSalary = baseSalary + bonus;

    SELECT grossSalary;
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
DROP PROCEDURE IF EXISTS calculateSalary;
EOT;

        DB::unprepared($query);
    }
};
