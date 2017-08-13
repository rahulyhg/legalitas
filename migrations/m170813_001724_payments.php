<?php

use yii\db\Migration;

class m170813_001724_payments extends Migration
{
    
    public function up()
    {
        $tableOptions =null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%payments}}',[
            'id' => $this->primaryKey(),
            'charge_id' => $this->string(25)->notNull(),
            'monto' => $this->float()->notNull(),
            'fecha' =>$this->integer()->notNull(),
            ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%payments}}');
        echo "Se borro la tabla con exito.\n";
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}