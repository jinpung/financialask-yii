<?php

class m140915_014820_remove_adviser_suburb extends CDbMigration
{
	public function up()
  {
    $tableName = Adviser::model()->tableName();
    $this->dropColumn($tableName, 'suburb');
	}

	public function down()
	{
    $tableName = Adviser::model()->tableName();
    $this->addColumn($tableName, 'suburb', 'varchar(50) NOT NULL');
		return false;
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
