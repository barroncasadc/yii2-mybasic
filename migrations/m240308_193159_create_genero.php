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
        // $sql2 = " YOUR SQL HERE ";
        // Yii::$app->db->createCommand($sql2)->execute();
    }
}
