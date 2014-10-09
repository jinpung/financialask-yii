<?php

class m140921_201543_insert_data_in_table_category extends CDbMigration
{
	public function safeUp()
	{
		foreach([
			        ['title'=>'Retirement','description'=>'Retirement'],
			        ['title'=>'Investment','description'=>'Investment'],
			        ['title'=>'Superannuation','description'=>'Superannuation'],
			        ['title'=>'Budgeting','description'=>'Budgeting'],
			        ['title'=>'Trusts','description'=>'Trusts'],
			        ['title'=>'Insurance','description'=>'Insurance'],
			        ['title'=>'Wealth','description'=>'Wealth'],
			        ['title'=>'Building','description'=>'Building'],
			        ['title'=>'Property','description'=>'Property'],
			        ['title'=>'SMSF','description'=>'SMSF'],
			        ['title'=>'Tax','description'=>'Tax']
		        ] as $row) {
			$this->insert(Category::model()->tableName(), $row);
		}
		return true;
	}

	public function down()
	{
		return true;
	}
}