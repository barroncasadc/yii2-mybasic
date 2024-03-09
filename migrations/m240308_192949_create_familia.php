<?php

use yii\db\Migration;

/**
 * Class m240308_192949_create_familia
 */
class m240308_192949_create_familia extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = Yii::$app->db->tablePrefix . 'familia';
        if (Yii::$app->db->getTableSchema($tableName, true) === null) {
            // Create
            $this->createTable($tableName, [
                'fami_codigo' => $this->primaryKey(),
                'fami_uuid' => $this->string(255)->notNull(),
                'fami_nome' => $this->string(255)->notNull(),
                
                // Default
                'fami_habilitado' => $this->integer()->notNull()->defaultValue(0),
                'fami_data_criacao' => $this->dateTime()->notNull(),
                'fami_data_alteracao' => $this->dateTime()->notNull(),
            ]);

            // Foreign-key (recebendo)
            // nothing

            // Seeds dump sql initial
            $this->seed();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240308_192949_create_familia cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240308_192949_create_familia cannot be reverted.\n";

        return false;
    }
    */

    // Seed insert - method 1
    private function seed() {
        // $sql2 = " YOUR SQL HERE ";
        // Yii::$app->db->createCommand($sql2)->execute();
    }
}
