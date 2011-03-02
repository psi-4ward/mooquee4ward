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


class Mooquee4ward extends Hybrid
{

	/**
	 * The key row
	 * @var str
	 */
	protected $strKey = 'id';
	
	/**
	 * Extend the parent method
	 * @return string
	 */
	public function generate()
	{
		if (!strlen($this->multiSRC))
		{
			return 'Please choose some Images';
		}

		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### Mooquee4ward ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile()
	{
		$GLOBALS['TL_JAVASCRIPT']['mooquee4ward'] = 'system/modules/mooquee4ward/html/Mooquee1.1.js';
		
		// fetch images
		
		$images = array();
		$multiSRC = unserialize($this->multiSRC);
		foreach($multiSRC as $file)
		{
			$images = array_merge($images,$this->fetchImages($file));
		}
		
		$this->addMooqueeParams($this);
		
		$this->Template->images = $images;
		$this->Template->firstitem = ($data->mooquee4wardFirstitem == 'random') ? array_rand($images) : $this->mooquee4wardFirstitem;
		
	}


	/**
	 * Adds the mooquee params to the template
	 */
	protected function addMooqueeParams($data)
	{
		$size = unserialize($data->mooquee4wardSize);
		$this->Template->width = $size[0];
		$this->Template->height = $size[1];
		
		$this->Template->duration = $data->mooquee4wardDuration;
		$this->Template->transin = $data->mooquee4wardTransin;
		$this->Template->transout = $data->mooquee4wardTransout;
		$this->Template->pause = $data->mooquee4wardPause;
		$this->Template->pauseOnHover = (($data->mooquee4wardPauseOnHover == '1') ? 'true' : 'false');
		$this->Template->showNav = $data->mooquee4wardShowNav == '1';
		$this->Template->firstitem = '0';
		
		$trans = $data->mooquee4wardTransition1;
		if($data->mooquee4wardTransition1 == 'linear')
		{
			// dont add in/out to linear transition
			$trans .= '';
		}
		elseif($data->mooquee4wardTransition2 == 'inOut')
		{
			$trans .= ':in:out';
		}
		else
		{
			$trans .= ':'.$data->mooquee4wardTransition2;	
		}
		$this->Template->transition = "'".$trans."'";		
	}
	
	/**
	 * Browse the directory structure and fetch all albums
	 * @param string
	 */
	protected function fetchImages($file)
	{
		if(is_dir(TL_ROOT . '/' . $file))
		{
			$this->parseMetaFile($file);
			// Scan folder an sort resources
			$images = scan(TL_ROOT . '/' . $file);
			natcasesort($images);
			foreach($images as $k=>$img) $images[$k] = $file.'/'.$img;
			$images = array_values($images);
		}
		else 
		{
			$images = array($file);
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
			if (is_dir(TL_ROOT .  '/' . $images[$i]))
			{
				continue;
			}

			$objFile = new File($images[$i]);

			// Skip non-image files
			if (!$objFile->isGdImage)
			{
				continue;
			}

			$erg[] = array
			(
				'title' => strlen($this->arrMeta[$objFile->basename][0]) ? $this->arrMeta[$objFile->basename][0] : ucfirst(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename))),
				'timestamp' => $objFile->mtime,
				'image' => $images[$i]
			);
		}
		
		return $erg;
	}
}

?>