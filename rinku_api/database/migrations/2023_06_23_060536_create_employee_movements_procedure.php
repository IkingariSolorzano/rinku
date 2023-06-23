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
CREATE PROCEDURE getEmployeeMovements(IN employeeId INT)
BEGIN
    SELECT *
    FROM employees e
    LEFT JOIN movements m ON e.id = m.employee_id
    WHERE e.id = employeeId;
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
DROP PROCEDURE IF EXISTS getEmployeeMovements;
EOT;

        DB::unprepared($query);
    }
};
