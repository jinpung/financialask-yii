<?php

class m140905_170558_create_table_feedback extends CDbMigration
{
	public function up()
	{
		$this->createTable('Feedback',array(
			'id'=>'pk',
			'userId'=>'integer NOT NULL',
			'adviserId'=>'integer NOT NULL',
			'title'=>'string NOT NULL',
			'content'=>'text NOT NULL',
			'datetime'=>'timestamp NOT NULL',
			'type'=>'boolean NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('Feedback');
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