<?php
/**
 * Created by PhpStorm.
 * User: darkwavemd
 * Date: 10.09.2014
 * Time: 16:50
 */

class LoremPixelWidget extends CWidget{
	/**
	 * Width of the image to generate
	 * Default to 320
	 * @var int
	 */
	public $width = 320;

	/**
	 * Height of the image to generate
	 * Default to 240
	 * @var int
	 */
	public $height = 240;

	/**
	 * Category of the image to generate.
	 * Random if null.
	 * Default to NULL
	 * @var string|NULL
	 */
	public $category;

	/**
	 * Generate only gray images
	 * Default to FALSE
	 * @var int
	 */
	public $gray = FALSE;

	/**
	 * Must be used with a category
	 * Text to display on the image.
	 * Default to NULL
	 * @var string
	 */
	public $text;

	/**
	 * Must be used with a category
	 * id of the image to show (1/10)
	 * of the given category name.
	 * Default to 1
	 * @var int
	 */
	public static $number = 1;

	/**
	 * The alt text of the image
	 * Default to demo image
	 * @var string
	 */
	public $alt='demo image';

	/**
	 * Html options of the image
	 * @var int
	 */
	public $htmlOptions = array();

	/**
	 * Available image categories
	 * @var array
	 */
	protected $_categories = array(
		'abstract',
		'animal',
		'business',
		'city',
		'food',
		'nightlife',
		'fashion',
		'people',
		'nature',
		'sports',
		'technics',
		'transport'
	);

	/**
	 * Url of the lorempixel website
	 * @var string
	 */
	protected $_url = 'http://lorempixel.com';

	/**
	 * Run the widget
	 */
	public function run()
	{
		$url = $this->_url . '/';

		// is gray image?
		if($this->gray)
			$url .= 'g/';

		$url .= (int)$this->width . '/' . (int)$this->height ;

		// add the category
		if($this->category)
		{
			$category = strtolower($this->category);
			if(in_array($category, $this->_categories))
			{
				$url .=  '/' . $category;

				// if a number is given
				if(self::$number < 10)
					self::$number++;
				$url .=  '/' . self::$number;
				// if has text to display
				if($this->text)
					$url .=  '/' . urlencode($this->text);
			} else throw new CException('Wrong category name');
		}

		// output the rendered image
		echo CHtml::image($url,$this->alt,$this->htmlOptions);
	}


} 