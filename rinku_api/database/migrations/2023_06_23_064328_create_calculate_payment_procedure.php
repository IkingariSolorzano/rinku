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
CREATE PROCEDURE calculatePayment(IN employeeId INT)
BEGIN
    DECLARE totalSalary DECIMAL(10, 2);
    DECLARE effectivePayment DECIMAL(10, 2);
    DECLARE voucherPayment DECIMAL(10, 2);

    SELECT calculateTotalSalary(employeeId) INTO totalSalary;

    SET effectivePayment = totalSalary * 0.96;
    SET voucherPayment = totalSalary * 0.04;

    SELECT effectivePayment, voucherPayment;
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
DROP PROCEDURE IF EXISTS calculatePayment;
EOT;

        DB::unprepared($query);
    }
};
