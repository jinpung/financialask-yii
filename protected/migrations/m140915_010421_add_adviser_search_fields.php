<?php

class m140915_010421_add_adviser_search_fields extends CDbMigration
{
	public function up()
  {
    $tableName = Adviser::model()->tableName();
    $this->addColumn($tableName, 'suburb', 'varchar(50) NOT NULL');
    $this->addColumn($tableName, 'yearStartPractice', 'integer NOT NULL');
	}

	public function down()
  {
    $tableName = Adviser::model()->tableName();
    $this->dropColumn($tableName, 'suburb');
    $this->dropColumn($tableName, 'yearStartPractice');
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
