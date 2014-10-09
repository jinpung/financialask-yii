<?php

class m140921_182324_add_direct_call_to_adviser extends CDbMigration
{
	public function up()
	{
		$this->addColumn(Adviser::model()->tableName(),'directCalls','boolean NOT NULL');
	}

	public function down()
	{
		$this->dropColumn(Adviser::model()->tableName(),'directCalls');
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