<?php

class m141001_133617_add_newAttributesToAdvisers extends CDbMigration
{
	public function up()
	{
		$this -> addColumn('Advisers','website','varchar(500)');
		$this -> addColumn('Advisers','phone','varchar(20) NOT NULL');
		$this -> addColumn('Advisers','company','varchar(255) NOT NULL');
		$this -> addColumn('Advisers','mobile','varchar(20)');
		$this -> addColumn('Advisers','email','varchar(255)');
		$this -> addColumn('Advisers','suburb','varchar(255)');
		$this -> addColumn('Advisers','state','varchar(20)');
	}

	public function down()
	{
		$this -> dropColumn('Advisers', 'website');
		$this -> dropColumn('Advisers','phone');
		$this -> dropColumn('Advisers','company');
		$this -> dropColumn('Advisers','mobile');
		$this -> dropColumn('Advisers','email');
		$this -> dropColumn('Advisers','suburb');
		$this -> dropColumn('Advisers','state');
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
