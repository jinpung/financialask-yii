<?php

class m140910_144634_add_field_active_for_advisers extends CDbMigration
{
	public function up()
	{
		$this->addColumn(Adviser::model()->tableName(),'active','boolean NOT NULL');
	}

	public function down()
	{
		$this->dropColumn(Adviser::model()->tableName(),'active');
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
