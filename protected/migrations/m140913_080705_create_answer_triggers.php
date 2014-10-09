<?php

class m140913_080705_create_answer_triggers extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("CREATE TRIGGER `QuestionResponseInsert` AFTER INSERT ON `QuestionResponses`
 FOR EACH ROW BEGIN
	INSERT INTO FeedItems SET feedTypeID = 2, instID = NEW.id, `datetime` = NEW.`datetime`;
END");
		$this->execute("CREATE TRIGGER `QuestionResponseDelete` BEFORE DELETE ON `QuestionResponses`
 FOR EACH ROW
 DELETE FROM FeedItems WHERE feedTypeID = 2 AND instID = OLD.id");
		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TRIGGER IF EXISTS QuestionResponseInsert');
		$this->execute('DROP TRIGGER IF EXISTS QuestionResponseDelete');
		return true;
	}
}