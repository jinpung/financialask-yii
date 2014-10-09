<?php

class m140918_152313_create_table_AdviserSchedule extends CDbMigration
{
	public function up()
	{
		$this->createTable('AdviserSchedule',array(
			'id'=>'pk',
			'adviserId'=>'integer NOT NULL',
			'startTime'=>'string NOT NULL',
			'endTime'=>'string NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('AdviserSchedule');
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