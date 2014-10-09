<?php

class m140911_182525_create_table_recommendations extends CDbMigration
{
	public function up()
	{
		$this->createTable('Recommendations',array(
			'id'=>'pk',
			'adviserId'=>'integer NOT NULL',
			'authorId'=>'integer NOT NULL',
			'content'=>'string NOT NULL',
			'datetime'=>'timestamp NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('Recommendations');
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