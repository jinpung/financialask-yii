<?php

class m140909_182116_create_table_tips extends CDbMigration
{
	public function up()
	{
		$this->createTable('Tips',array(
			'id'=>'pk',
			'adviserId'=>'integer NOT NULL',
			'title'=>'string NOT NULL',
			'content'=>'text NOT NULL',
			'datetime'=>'timestamp NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('Tips');
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