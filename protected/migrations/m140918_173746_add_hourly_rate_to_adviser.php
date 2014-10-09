<?php

class m140918_173746_add_hourly_rate_to_adviser extends CDbMigration
{
	public function up()
	{
		$this->addColumn(Adviser::model()->tableName(),'rate','decimal(5,2) NOT NULL');
	}

	public function down()
	{
		$this->dropColumn(Adviser::model()->tableName(),'rate');
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