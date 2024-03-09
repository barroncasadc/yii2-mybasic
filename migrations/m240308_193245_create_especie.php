<?php

use yii\db\Migration;

/**
 * Class m240308_193245_create_especie
 */
class m240308_193245_create_especie extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = Yii::$app->db->tablePrefix . 'especie';
        if (Yii::$app->db->getTableSchema($tableName, true) === null) {
            // Create
            $this->createTable($tableName, [
                'espe_codigo' => $this->primaryKey(),
                'espe_uuid' => $this->string(255)->notNull(),
                'espe_nome' => $this->string(255)->notNull(),

                // Foreign-key (recebendo) (recebendo)
                'fami_codigo' => $this->integer()->notNull(),
                'gene_codigo' => $this->integer()->notNull(),

                // Default
                'espe_habilitado' => $this->integer()->notNull()->defaultValue(0),
                'espe_data_criacao' => $this->dateTime()->notNull(),
                'espe_data_alteracao' => $this->dateTime()->notNull(),
            ]);

            // Foreign-key (recebendo)
            $this->addForeignKey(
                'familia_especie_fk', // OtherTable_x_thisTable_fk
                'especie', 'fami_codigo', // this table
                'familia', 'fami_codigo' // reference table
            );
            $this->addForeignKey(
                'genero_especie_fk', // OtherTable_x_thisTable_fk
                'especie', 'gene_codigo', // this table
                'genero', 'gene_codigo' // reference table
            );

            // Seeds dump sql initial
            $this->seed();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240308_193245_create_especie cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240308_193245_create_especie cannot be reverted.\n";

        return false;
    }
    */

    // Seed insert - method 1
    private function seed() {
        // $sql2 = " YOUR SQL HERE ";
        // Yii::$app->db->createCommand($sql2)->execute();
    }
}
