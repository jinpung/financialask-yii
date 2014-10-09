<?php

class GenerateFeedsCommand extends CConsoleCommand
{
	const ROWS = 1000;
	public function run($args)
	{
		for($i=0;$i<self::ROWS;$i++)
		{
			printf("Entering %d of %d\n",$i+1,self::ROWS);

			$q = new Question();
			$q->userId = $this->getRandomUserId();
			$q->content = $this->getRandomText();
			$q->save(false);
		}
	}

	protected function getRandomText()
	{
		static $lines = array();
		do {
			if(!count($lines)) {
				$content = file_get_contents('http://loripsum.net/api/100/short/plaintext');
				$lines = preg_split('/[\n]+/', $content);
				unset($lines[0]);
			}
			$text = trim(array_pop($lines));
		} while(!strlen($text));

		return $text;
	}

	protected function getRandomUserId()
	{
		$connection=Yii::app()->db;
		$command=$connection->createCommand('select id from Users order by rand() limit 1');
		$command->execute();
		return $command->queryColumn()[0];
	}

}