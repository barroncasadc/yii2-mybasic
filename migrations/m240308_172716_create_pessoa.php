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
        // $sql2 = " YOUR SQL HERE ";
        // Yii::$app->db->createCommand($sql2)->execute();
    }
}
