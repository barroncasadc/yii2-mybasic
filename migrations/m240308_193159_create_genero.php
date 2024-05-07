<?php

use yii\db\Migration;

/**
 * Class m240308_193159_create_genero
 */
class m240308_193159_create_genero extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = Yii::$app->db->tablePrefix . 'genero';
        if (Yii::$app->db->getTableSchema($tableName, true) === null) {
            // Create
            $this->createTable($tableName, [
                'gene_codigo' => $this->primaryKey(),
                'gene_uuid' => $this->string(255)->notNull(),
                'gene_nome' => $this->string(255)->notNull(),

                // Default
                'gene_habilitado' => $this->integer()->notNull()->defaultValue(0),
                'gene_data_criacao' => $this->dateTime()->notNull(),
                'gene_data_alteracao' => $this->dateTime()->notNull(),
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
        echo "m240308_193159_create_genero cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240308_193159_create_genero cannot be reverted.\n";

        return false;
    }
    */

    // Seed insert - method 1
    private function seed() {
        // https://www.slideshare.net/jlna/atlas-dos-discus
        $sql2 = "
            INSERT INTO `genero` (`gene_codigo`, `gene_uuid`,  `gene_nome`, `gene_habilitado`, `gene_data_criacao`, `gene_data_alteracao`) VALUES
            (1, 'efd1f700-de39-4841-b49a-fc672c34c34e', 'symphysodon', 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53');
        ";
        Yii::$app->db->createCommand($sql2)->execute();
    }
}
