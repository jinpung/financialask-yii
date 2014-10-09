<?php

class m140929_055817_add_reference_columns extends CDbMigration
{
	public function up()
  {
    $this->addColumn(Question::model()->tableName(), 'refURL', 'varchar(500)');
    $this->addColumn(QuestionResponse::model()->tableName(), 'refURL', 'varchar(500)');
	}

	public function down()
  {
    $this->dropColumn(Question::model()->tableName(), 'refURL');
    $this->dropColumn(QuestionResponse::model()->tableName(), 'refURL');
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
