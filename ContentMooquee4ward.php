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


class ContentMooquee4ward extends ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_mooquee4ward';


	/**
	 * Extend the parent method
	 * @return string
	 */
	public function generate()
	{
		if (!strlen($this->multiSRC))
		{
			return '';
		}

		if (TL_MODE == 'BE')
		{
			return '';
		}

		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile()
	{
	//	$GLOBALS['TL_CSS']['mooquee4ward'] = 'system/modules/mooquee4ward/html/mooquee.css';
		$GLOBALS['TL_JAVASCRIPT']['mooquee4ward'] = 'system/modules/mooquee4ward/html/Mooquee1.1.js';
		
		// fetch images
		
		$images = array();
		$multiSRC = unserialize($this->multiSRC);
		foreach($multiSRC as $file)
		{
			$images = array_merge($images,$this->fetchImages($file));
		}
		
		$this->Template->images = $images;
		
		$size = unserialize($this->mooquee4wardSize);
		$this->Template->width = $size[0];
		$this->Template->height = $size[1];
		
		$this->Template->duration = $this->mooquee4wardDuration;
		$this->Template->transin = $this->mooquee4wardTransin;
		$this->Template->transout = $this->mooquee4wardTransout;
		$this->Template->pause = $this->mooquee4wardPause;
		$this->Template->pauseOnHover = (($this->mooquee4wardPauseOnHover == '1') ? 'true' : 'false');
		$this->Template->showNav = $this->mooquee4wardShowNav == '1';
		$this->Template->firstitem = ($this->mooquee4wardFirstitem == 'random') ? array_rand($images) : $this->mooquee4wardFirstitem;
		
		$this->Template->transition = "'".$this->mooquee4wardTransition1 . (($this->mooquee4wardTransition2 == 'inOut') ? ':in:out' : ':'.$this->mooquee4wardTransition2)."'";
	}


	/**
	 * Browse the directory structure and fetch all albums
	 * @param string
	 */
	private function fetchImages($url)
	{
		if(is_dir(TL_ROOT . '/' . $url))
		{
			$this->parseMetaFile($url);
			// Scan folder an sort resources
			$images = scan(TL_ROOT . '/' . $url);
			natcasesort($images);
			$images = array_values($images);
		}
		else 
		{
			$images = array($url);
		}
		

		$erg = array();
		for ($i=0; $i<count($images); $i++)
		{
			// Skip hidden files or folders
			if (strncmp($images[$i], '.', 1) === 0)
			{
				continue;
			}

			// Dont add subfolder
			if (is_dir(TL_ROOT . '/' . $url . '/' . $images[$i]))
			{
				continue;
			}

			$objFile = new File($url . '/' . $images[$i]);

			// Skip non-image files
			if (!$objFile->isGdImage)
			{
				continue;
			}

			$erg[] = array
			(
				'title' => strlen($this->arrMeta[$objFile->basename][0]) ? $this->arrMeta[$objFile->basename][0] : ucfirst(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename))),
				'timestamp' => $objFile->mtime,
				'image' => $url . '/' . $images[$i]
			);
		}
		
		return $erg;
	}
}

?>