<?php

class m140903_154509_create_table_calls extends CDbMigration
{
	public function up()
	{
		$this->createTable('Calls',array(
			'id'=>'pk',
			'userId'=>'integer NOT NULL',
			'adviserId'=>'integer NOT NULL',
			'sessionId'=>'string',
			'datatime'=>'timestamp NOT NULL',
			'status'=>'boolean NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('Calls');
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