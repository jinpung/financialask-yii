<?php

class m140924_044230_add_adviser_unclaimed extends CDbMigration
{
	public function up()
  {
    $this->addColumn(Adviser::model()->tableName(), 'unclaimed', 'boolean NOT NULL');
	}

	public function down()
  {
    $this->dropColumn(Adviser::model()->tableName(), 'unclaimed');
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
