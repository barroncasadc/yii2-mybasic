<?php

use yii\db\Migration;

/**
 * Class m240308_172716_create_pessoa
 */
class m240308_172716_create_pessoa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = Yii::$app->db->tablePrefix . 'pessoa';
        if (Yii::$app->db->getTableSchema($tableName, true) === null) {
            // Create
            $this->createTable($tableName, [
                'pess_codigo' => $this->primaryKey(),
                'pess_uuid' => $this->string(255)->notNull(),
                'pess_nome' => $this->string(255)->notNull(),
                'pess_email' => $this->string(255)->notNull(),
                'pess_senha' => $this->string(80)->notNull(),
                'pess_token' => $this->string(80)->notNull(),

                // Foreign-key (recebendo) (recebendo)
                'peti_codigo' => $this->integer()->notNull(),

                // Default
                'pess_imagem' => $this->string(80),
                'pess_habilitado' => $this->integer()->notNull()->defaultValue(0),
                'pess_data_criacao' => $this->dateTime()->notNull(),
                'pess_data_alteracao' => $this->dateTime()->notNull(),
            ]);

            // Foreign-key (recebendo) (recebendo)
            $this->addForeignKey(
                'pessoa_tipo_pessoa_fk', // OtherTable_x_thisTable_fk
                'pessoa', 'peti_codigo', // this table
                'pessoa_tipo', 'peti_codigo' // reference table
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
        echo "m240308_172716_create_pessoa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240308_172716_create_pessoa cannot be reverted.\n";

        return false;
    }
    */

    // Seed insert - method 1
    private function seed() {
        // https://www.slideshare.net/jlna/atlas-dos-discus
        $sql2 = "
            INSERT INTO `pessoa` (`pess_codigo`, `pess_uuid`, `pess_nome`, `pess_email`, `pess_senha`, `pess_token`, `peti_codigo`, `pess_imagem`, `pess_habilitado`, `pess_data_criacao`, `pess_data_alteracao`) VALUES
            ('1', 'efd1f788-de39-4841-b49a-fc670c34c35e', 'caio cesar', 'barroncasadc@gmail.com', '$2y$13$auNQhK4fYj5cTk5t0Y9wiecDe5UkcPl9i4eYzV9FsyymWYkuBqWqu', 'gId11M-e4Iz0dqEDj6pijstBiJ0-vQap', 1, 'default.png', 1, '2024-04-02 11:53:04', '2024-04-02 11:53:04');
        ";
        Yii::$app->db->createCommand($sql2)->execute();
    }
}
