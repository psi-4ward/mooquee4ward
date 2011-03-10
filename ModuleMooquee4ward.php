<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  4ward.media 2010
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    Mooquee4ward
 * @license    LGPL 
 * @filesource
 */


class ModuleMooquee4ward extends Mooquee4ward
{

	/**
	 * Table holding the params
	 * @var string
	 */
	protected $strTable = 'tl_module';
	
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_mooquee4ward';

	public function generate()
	{
		$this->size = $this->imgSize;
		return parent::generate();
	}
}

?>