<?php

class m140905_125055_create_table_booking_for extends CDbMigration
{
	public function up()
	{
		$this->createTable('Booking',array(
			'id'=>'pk',
			'userId'=>'integer NOT NULL',
			'adviserId'=>'integer NOT NULL',
			'callId'=>'integer NOT NULL',
			'reason'=>'text NOT NULL',
			'datetime'=>'timestamp NOT NULL',
		));
	}

	public function down()
	{
		$this->dropTable('Booking');
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