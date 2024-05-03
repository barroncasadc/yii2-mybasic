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
                'espe_imagem' => $this->string(255),

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
        // https://www.slideshare.net/jlna/atlas-dos-discus
        $sql2 = "
            INSERT INTO `especie` (`espe_codigo`, `espe_uuid`,  `espe_nome`, `espe_imagem`, `fami_codigo`, `gene_codigo`, `espe_habilitado`, `espe_data_criacao`, `espe_data_alteracao`) VALUES
            (1, 'efd1f713-de39-4841-b49a-fc672c34c34e', 'orange nhamunda', null, 1, 1, 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53'),
            (2, 'efd1f713-de39-4842-b49a-fc672c34c34e', 'albino gold', null, 1, 1, 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53'),
            (3, 'efd1f713-de39-4843-b49a-fc672c34c34e', 'alenquer', null, 1, 1, 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53'),
            (4, 'efd1f713-de39-4844-b49a-fc672c34c34e', 'angel drean', null, 1, 1, 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53'),
            (5, 'efd1f713-de39-4845-b49a-fc672c34c34e', 'angel diamond', null, 1, 1, 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53'),
            (6, 'efd1f713-de39-4846-b49a-fc672c34c34e', 'blue heckel cross', null, 1, 1, 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53'),
            (7, 'efd1f713-de39-4847-b49a-fc672c34c34e', 'checkerboard pigeon', null, 1, 1, 1, '2022-04-23 01:19:53', '2022-04-23 01:19:53');
        ";
        Yii::$app->db->createCommand($sql2)->execute();
    }
}
