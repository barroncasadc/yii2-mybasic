<?php

use yii\db\Migration;

/**
 * Class m240308_172712_create_pessoa_tipo
 */
class m240308_172712_create_pessoa_tipo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = Yii::$app->db->tablePrefix . 'pessoa_tipo';
        if (Yii::$app->db->getTableSchema($tableName, true) === null) {
            // Create
            $this->createTable($tableName, [
                'peti_codigo' => $this->primaryKey(),
                'peti_nome' => $this->string(255)->notNull(),

                // Foreign-key (recebendo) (recebendo)
                // nothing

                // Default
                'peti_habilitado' => $this->integer()->notNull()->defaultValue(0),
                'peti_data_criacao' => $this->dateTime()->notNull(),
                'peti_data_alteracao' => $this->dateTime()->notNull(),
            ]);

            // Foreign-key (recebendo) (recebendo)
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
        echo "m240308_172712_create_pessoa_tipo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240308_172712_create_pessoa_tipo cannot be reverted.\n";

        return false;
    }
    */

    // Seed insert - method 1
    private function seed() {
        $sql2 = "
            INSERT INTO `pessoa_tipo` (`peti_codigo`, `peti_nome`, `peti_habilitado`, `peti_data_criacao`, `peti_data_alteracao`) VALUES
            (1, 'admin', 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53'),
            (2, 'usuario', 1, '2022-04-23 01:22:01', '2022-04-23 01:22:01');
        ";
        Yii::$app->db->createCommand($sql2)->execute();
    }
}
