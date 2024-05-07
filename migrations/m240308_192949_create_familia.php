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
        // https://www.slideshare.net/jlna/atlas-dos-discus
        $sql2 = "
            INSERT INTO `familia` (`fami_codigo`, `fami_uuid`,  `fami_nome`, `fami_habilitado`, `fami_data_criacao`, `fami_data_alteracao`) VALUES
            (1, 'efd1f713-de39-4841-b77a-fc672c34c34e', 'cichlidae', 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53');
        ";
        Yii::$app->db->createCommand($sql2)->execute();
    }
}
