<?php

class m140918_202148_add_credit_to_user_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn(User::model()->tableName(),'credit','decimal(7,2) NOT NULL');
	}

	public function down()
	{
		$this->dropColumn(User::model()->tableName(),'credit');

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