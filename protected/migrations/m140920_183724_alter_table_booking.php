<?php

class m140920_183724_alter_table_booking extends CDbMigration
{
	public function up()
	{
		$this->addColumn(Booking::model()->tableName(),'start','timestamp NOT NULL');
		$this->addColumn(Booking::model()->tableName(),'end','timestamp NOT NULL');
	}
	public function down()
	{
		$this->dropColumn(Booking::model()->tableName(),'start');
		$this->dropColumn(Booking::model()->tableName(),'end');
	}
}