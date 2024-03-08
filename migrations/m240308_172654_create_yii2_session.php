<?php

use yii\db\Migration;

/**
 * Class m240308_172654_create_yii2_session
 */
class m240308_172654_create_yii2_session extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = Yii::$app->db->tablePrefix . 'yii_session';
        if (Yii::$app->db->getTableSchema($tableName, true) === null) {
            // Create
            $this->createTable($tableName, [
                'id' => $this->string(40)->notNull(),
                'expire' => $this->integer()->notNull(),
                'data' => $this->binary(429496729)->notNull(),
                'PRIMARY KEY(id)',
            ]);
            
            // Foreign-key (recebendo) (recebendo)
            # nothing

            // Seeds dump sql initial
            $this->seed();
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240308_172654_create_yii2_session cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240308_172654_create_yii2_session cannot be reverted.\n";

        return false;
    }
    */

    // Seed insert - method 1
    private function seed() {
        // $sql2 = " YOUR SQL HERE ";
        // Yii::$app->db->createCommand($sql2)->execute();
    }
}
