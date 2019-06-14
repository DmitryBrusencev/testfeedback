<?php

use yii\db\Migration;

/**
 * Class m190516_055456_create_user
 */
class m190516_055456_create_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('user', [
            'id'            => $this->primaryKey(),
            'firstname'     => $this->string(64)->notNull(),
            'surname'       => $this->string(64)->notNull(),
            'login'         => $this->string(32)->notNull(),
            'password'      => $this->string(50)->notNull(),
            'email'         => $this->string(64)->notNull()->unique(),
            'phone'         => $this->string(11)->unique(),
            'auth_key'      => $this->string(64)->unique(),
            'activated'     => $this->integer(1)->notNull(),
            'status'        => $this->integer(2)->notNull(),
            'created_at'    => $this->date()->notNull(),
            'secret_key'    => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190516_055456_create_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190516_055456_create_user cannot be reverted.\n";

        return false;
    }
    */
}
