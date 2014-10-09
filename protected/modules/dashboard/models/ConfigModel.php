<?php
class ConfigModel extends CFormModel{

	public $type;
	public $key;
	public $value;
	public $isNewRecord = true;
	const  configFile = 'config.json';

	/**
	 * @param string $className
	 * @return ConfigModel
	 */
	public static function model($className=__CLASS__)
	{
		return new $className;
	}

	public function rules()
	{
		return array(
			array('type, key, value', 'required'),
		);
	}

	public function save()
	{
		$data = array(
			$this->type =>array(
				$this->key => $this->value
			)
		);
		$configData = self::getConfigData();
		return file_put_contents(
				$this->getConfigFile(),
				json_encode(
					array_merge_recursive($data,$configData),
					JSON_PRETTY_PRINT
				)
		);
	}

	public static function getConfigData()
	{
		return CJSON::decode(file_get_contents(Yii::getPathOfAlias('application.config.').'/'.self::configFile));
	}

	public static function setConfigData($data)
	{
		return file_put_contents(
			self::model()->getConfigFile(),
			json_encode(
				$data,
				JSON_PRETTY_PRINT
			)
		);
	}

	public static function getDataProvider()
	{
		$data = self::getConfigData();
		$result = array();
		$id = 0;
		foreach($data as $type => $item)
		{
			while (list($key, $value) = each($item)) {
				$result[$id]['type'] = $type;
				$result[$id]['key'] = $key;
				$result[$id]['value'] = $value;
				$result[$id]['id'] = $id;
				$id++;
			}
		}
		return new CArrayDataProvider($result);
	}

	protected function getConfigFile()
	{
		return Yii::getPathOfAlias('application.config.').'/'.self::configFile;
	}
}