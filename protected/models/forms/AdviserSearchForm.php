<?php

/**
 * This is the model class for Advisers advanced search form
 *
 * The followings are the available fields at form:
 * @property string $displayname
 * @property string $address
 * @property string $suburb
 * @property string $postcode
 * @property string $bio
 * @property string $awardTitle
 * @property string $awardInstitution
 * @property string $educationTitle
 * @property int    $educationYear
 * @property string $educationInstitution
 * @property string $publicationTitle
 * @property int    $publicationYear
 * @property string $publicationPublisher
 * @property array  $specialtiesList
 * @property int    $answersCount
 * @property int    $averageRate
 * @property int    $online
 *
 */
class AdviserSearchForm extends CFormModel
{

	public $displayname;
	public $address;
	public $suburb;
	public $postcode;
	public $bio;
	public $awardTitle;
	public $awardInstitution;
	public $educationTitle;
	public $educationYear;
	public $educationInstitution;
	public $publicationTitle;
	public $publicationYear;
	public $publicationPublisher;
	public $specialtiesList = array();
	public $answersCount;
	public $averageRate;
	public $online;

	/**
	 * @return array Declares validation rules for search
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('educationYear,publicationYear', 'numerical', 'integerOnly' => true, 'min' => 1900, 'max' => date('Y')),
			array(
				'displayname,address,suburb,postcode,bio,awardTitle,
				awardInstitution,educationTitle,educationYear,
				educationInstitution,publicationTitle,publicationYear,
				publicationPublisher,specialtiesList,answersCount,averageRate,online',
				'safe'
			)
		);
	}

	public function attributeLabels()
	{

		return array(
			'displayname' => 'Display name'
		);
	}

	public function advancedSearch()
	{
		$criteria = new CDbCriteria;
		if ($this->validate()) {
			$criteria->together = true;
			$criteria->with = array(
				'user',
				'specialties',
				'awards',
				'educations',
				'publications'
			);
			$criteria->compare('user.displayname', $this->displayname, true);
			$criteria->compare('awards.title', $this->awardTitle, true);
			$criteria->compare('awards.institution', $this->awardInstitution, true);
			$criteria->compare('publications.title', $this->publicationTitle, true);
			$criteria->compare('publications.year', $this->publicationYear, true);
			$criteria->compare('publications.publisher', $this->publicationPublisher, true);
			$criteria->compare('educations.title', $this->educationTitle, true);
			$criteria->compare('educations.year', $this->educationYear, true);
			$criteria->compare('educations.institution', $this->educationInstitution, true);
			$criteria->compare('address', $this->address, true);
			$criteria->compare('suburb', $this->suburb, true);
			$criteria->compare('postcode', $this->postcode, true);
			$criteria->compare('bio', $this->bio, true);
			$flag = false;
			if(is_array($this->specialtiesList))
				foreach($this->specialtiesList as $spec)
				{
					if($spec)
						$flag = true;
				}
			if ($flag)
				$criteria->addInCondition('specialties.specId', $this->specialtiesList);
			if($this->online)
				$criteria->addCondition('TIME_TO_SEC(TIMEDIFF(NOW(),t.actiontime)) < '.Adviser::TIME_LIMIT);
		}
		return new CActiveDataProvider('Adviser', array(
			'criteria' => $criteria,
		));
	}


}