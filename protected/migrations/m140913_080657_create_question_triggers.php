<?php

class m140913_080657_create_question_triggers extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("CREATE TRIGGER `QuestionInsert` AFTER INSERT ON `Questions`
 FOR EACH ROW BEGIN
	INSERT INTO FeedItems SET feedTypeID = 1, instID = NEW.id, `datetime` = NEW.`datetime`;
END");
		$this->execute("CREATE TRIGGER `QuestionDelete` BEFORE DELETE ON `Questions`
 FOR EACH ROW DELETE FROM FeedItems WHERE feedTypeID = 1 AND instID = OLD.id");
		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TRIGGER IF EXISTS QuestionInsert');
		$this->execute('DROP TRIGGER IF EXISTS QuestionDelete');
		return true;
	}
}