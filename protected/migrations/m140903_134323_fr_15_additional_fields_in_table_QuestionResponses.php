<?php

class m140903_134323_fr_15_additional_fields_in_table_QuestionResponses extends CDbMigration
{
	public function up()
	{
		$tableName = QuestionResponse::model()->tableName();
		$this->addColumn($tableName,'summary','varchar(50) not null');
	}

	public function down()
	{
		$tableName = QuestionResponse::model()->tableName();
		$this->dropColumn($tableName,'summary');
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