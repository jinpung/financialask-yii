<?php

class m140917_082832_create_questionFollow_table extends CDbMigration
{
	public function up()
  {
    $this->createTable('QuestionFollow', array(
      'id' => 'pk',
      'userId' => 'integer NOT NULL',
      'questionId' => 'integer NOT NULL',
      'datetime' => 'timestamp'));
	}

	public function down()
  {
    $this->dropTable('QuestionFollow');
    return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
