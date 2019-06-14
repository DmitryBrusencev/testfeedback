<?php

use yii\db\Migration;

/**
 * Class m190609_171458_feedback
 */
class m190609_171458_feedback extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('feedback', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(80)->notNull(),
            'email'         => $this->string(80)->notNull(),
            'message'       => $this->text()->notNull(),
            'created_at'    => $this->date()->notNull(),
            'feedback_ip'   => $this->string(20)->notNull(),
            'created_time'  => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('feedback');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190609_171458_feedback cannot be reverted.\n";

        return false;
    }
    */
}
