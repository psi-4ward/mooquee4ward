<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  4ward.media 2010
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    mooquee4ward
 * @license    LGPL 
 * @filesource
 */


class ContentMooquee4wardEnd extends Mooquee4ward
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_mooquee4ward_end';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### Mooquee4ward END ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}	
	
	
	/**
	 * Generate content element
	 */
	protected function compile()
	{
		$GLOBALS['TL_JAVASCRIPT']['mooquee4ward'] = 'system/modules/mooquee4ward/html/Mooquee1.1.js';
		
		// find start element
		$objStart = $this->Database->prepare('SELECT * FROM tl_content WHERE pid=? AND type="mooquee4wardStart" ORDER BY SORTING DESC')
							->limit(1)->execute($this->pid);
							
		if($objStart->numRows != 1) return;
		
		$this->addMooqueeParams($objStart);
	}
}


?>