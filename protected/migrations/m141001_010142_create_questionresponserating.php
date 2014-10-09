<?php

class m141001_010142_create_questionresponserating extends CDbMigration
{
	public function up()
	{
    $this->createTable('QuestionResponseRating', array(
      'id' => 'pk',
      'adviserId' => 'int(11) NOT NULL',
      'responseId' => 'int(11) NOT NULL',
      'rating' => 'varchar(45) NOT NULL',
      'feedback' => 'varchar(145) NOT NULL',
      'userId' => 'int(11) NOT NULL',
      'datetime' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
		));
                
	}

	public function down()
	{
		$this->dropTable('QuestionResponseRating');
		return true;
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
