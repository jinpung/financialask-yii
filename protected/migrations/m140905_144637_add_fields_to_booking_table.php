<?php

class m140905_144637_add_fields_to_booking_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn(Booking::model()->tableName(),'calltime','timestamp NOT NULL');
		$this->addColumn(Booking::model()->tableName(),'status','integer NOT NULL');
	}

	public function down()
	{
		$this->dropColumn(Booking::model()->tableName(),'calltime');
		$this->dropColumn(Booking::model()->tableName(),'status');
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
