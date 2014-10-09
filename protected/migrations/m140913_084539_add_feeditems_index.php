<?php

class m140913_084539_add_feeditems_index extends CDbMigration
{
	public function up()
	{
		$this->createIndex('FeedTypeIDInstID','FeedItems','feedTypeID,instID');
		return true;
	}

	public function down()
	{
		$this->dropIndex('FeedTypeIDInstID','FeedItems');
		return true;
	}
}