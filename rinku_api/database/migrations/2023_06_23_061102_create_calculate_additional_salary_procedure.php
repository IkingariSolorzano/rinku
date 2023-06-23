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
CREATE PROCEDURE calculateAdditionalSalary(IN movementId INT)
BEGIN
    DECLARE additionalSalary INT;

    SELECT cantidad_entregas * 5 INTO additionalSalary
    FROM movements
    WHERE id = movementId;

    SELECT additionalSalary;
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
DROP PROCEDURE IF EXISTS calculateAdditionalSalary;
EOT;

        DB::unprepared($query);
    }
};
