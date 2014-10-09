<?php
/**
 * Created by PhpStorm.
 * User: darkwavemd
 * Date: 21.09.2014
 * Time: 19:16
 */

class YiiIcal extends CApplicationComponent{

	protected $template  = <<<'EOD'
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
CALSCALE:GREGORIAN
BEGIN:VEVENT
DTEND:{end}
UID:{id}
DTSTAMP:{stamp}
ORGANIZER;CN={name}:mailto:{email}
LOCATION:{location}
DESCRIPTION:{description}
URL;VALUE=URI:{url}
SUMMARY:{summary}
DTSTART:{start}
END:VEVENT
END:VCALENDAR
EOD;

	public function generate($name,$email,$start,$end,$content)
	{
		$start = (new DateTime($start))->format('Ymd\THis\Z');
		$end = (new DateTime($end))->format('Ymd\THis\Z');
		return strtr($this->template,array(
			'{end}'=>$end,
			'{id}'=>uniqid(),
			'{stamp}'=> (new DateTime())->format('Ymd\THis\Z'),
			'{name}'=>$this->escapeString($name),
			'{email}'=>$this->escapeString($email),
			'{location}' =>$this->escapeString(Yii::app()->name),
			'{description}'=>$this->escapeString($content),
			'{url}'=>Yii::app()->request->getBaseUrl(true),
			'{summary}'=>$this->escapeString($content),
			'{start}'=>$start
		));


	}

	protected function escapeString($string) {
		return preg_replace('/([\,;])/','\\\$1', $string);
	}
} 