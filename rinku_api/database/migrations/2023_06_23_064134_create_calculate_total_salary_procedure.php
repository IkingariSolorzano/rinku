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
CREATE PROCEDURE calculateTotalSalary(IN employeeId INT)
BEGIN
    DECLARE totalSalary INT;
    DECLARE additionalSalary INT;

    SELECT calculateSalary(employeeId) INTO totalSalary;
    SELECT calculateAdditionalSalary(employeeId) INTO additionalSalary;

    SET totalSalary = totalSalary + additionalSalary;

    SELECT totalSalary;
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
DROP PROCEDURE IF EXISTS calculateTotalSalary;
EOT;

        DB::unprepared($query);
    }
};
