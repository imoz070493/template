<?php

use Illuminate\Database\Migrations\Migration;

class CreateCargoConfianzaTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'cargo_confianza';
        $logTableName = 'log_cargo_confianza';

        $columns = collect(DB::select(DB::raw("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tableName'")))->pluck('COLUMN_NAME')->toArray();
        DB::unprepared("DROP TRIGGER IF EXISTS `trg_${tableName}_trigger_insert`;
        CREATE TRIGGER trg_${tableName}_trigger_insert AFTER INSERT ON `${tableName}` FOR EACH ROW
        INSERT INTO ${logTableName} (
          historial_db_operation," . join(',', $columns) . "
          ) values (
            'I',NEW." . join(',NEW.', $columns) . "
          );
          ");
        DB::unprepared("DROP TRIGGER IF EXISTS `trg_${tableName}_trigger_update`;
            CREATE TRIGGER trg_${tableName}_trigger_update AFTER UPDATE ON ${tableName} FOR EACH ROW
            INSERT INTO ${logTableName} (
              historial_db_operation," . join(',', $columns) . "
            ) values (
              'U',NEW." . join(',NEW.', $columns) . "
           );
            ");

        DB::unprepared("DROP TRIGGER IF EXISTS `trg_${tableName}_trigger_delete`;
            CREATE TRIGGER trg_${tableName}_trigger_delete BEFORE DELETE ON `${tableName}` FOR EACH ROW
            INSERT INTO ${logTableName} (
              historial_db_operation," . join(',', $columns) . "
            ) values (
             'D',OLD." . join(',OLD.', $columns) . "
           )");

        /**
         * como obtener el ultimo estado de una fila
        SELECT log_table.* FROM log_table INNER JOIN (
        SELECT MAX(historial_db_id) latest FROM log_table GROUP BY id
        )as l ON historial_db_id=latest
         */

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableName = 'cargo_confianza';

        DB::unprepared("DROP TRIGGER IF EXISTS `trg_${tableName}_trigger_insert`");
        DB::unprepared("DROP TRIGGER IF EXISTS `trg_${tableName}_trigger_update`");
        DB::unprepared("DROP TRIGGER IF EXISTS `trg_${tableName}_trigger_delete`");

    }
}