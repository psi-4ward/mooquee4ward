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
		
		$this->Template->images = $images;
		$this->Template->mooquee4wardFirstitem = ($this->mooquee4wardFirstitem == 'random') ? array_rand($images) : $this->mooquee4wardFirstitem;
		$this->Template->imgSize = deserialize($this->size);
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
			$folderImages = scan(TL_ROOT . '/' . $file);
			natcasesort($folderImages);

			// if there is a meta file, use it's sorting
			$images = array();
			foreach($this->arrMeta as $fileName => $metadata) {
				$folderImagesKey = array_search($fileName, $folderImages);
				if(!$folderImagesKey) {
					continue; // the image exists in the meta file, but not in the folder
				}
				array_push($images, $file . '/' . $fileName);
				// remove from not-processed array
				unset($folderImages[$folderImagesKey]);
			}

			// now handle app files, which weren't in a meta file
			foreach($folderImages as $fileName) {
				array_push($images, $file . '/' . $fileName);
			}
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
				'image' => $images[$i],
				'link' => (!strlen($this->arrMeta[$objFile->basename][1]) && $this->fullsize) ? $images[$i] : $this->arrMeta[$objFile->basename][1],
				'description' => $this->arrMeta[$objFile->basename][2],
			);
		}
		
		return $erg;
	}


	public static function generateJavascript($objSettings)
	{
		$GLOBALS['TL_JAVASCRIPT']['mooquee4ward'] = 'system/modules/mooquee4ward/html/Mooquee1.1.js';

		$trans = $objSettings->mooquee4wardTransition1;
		if($objSettings->mooquee4wardTransition1 == 'linear')
		{
			// dont add in/out to linear transition
			$trans .= '';
		}
		elseif($objSettings->mooquee4wardTransition2 == 'inOut')
		{
			$trans .= ':in:out';
		}
		else
		{
			$trans .= ':'.$objSettings->mooquee4wardTransition2;
		}

		$size = unserialize($objSettings->mooquee4wardSize);

		$strJS = '
<script type="text/javascript">
	window.addEvent(\'domready\',function(){
		$$(\'#mooquee'.$objSettings->id.'\').setStyles({
			\'width\':\''.$size[0].'px\',
			\'height\':\''.$size[1].'px\'
		});
		$$(\'#mooquee'.$objSettings->id.' > div\').addClass(\'mooquee_item\');

';
		if($objSettings->mooquee4wardShowNav)
		{
$strJS .= '
		var mooqueeNav = new Element(\'div\',{\'class\':\'mooqueeNav\'});
			for(var i=0; i<$$(\'#mooquee'.$objSettings->id.' > div\').length;i++){
				new Element(\'a\',{
					\'onclick\':\'objMooquee'.$objSettings->id.'.moove(\'+i+\');return false;\',
					\'href\':\'#\',
					\'class\':((i==0) ? \'active\' : \'\'),
					\'text\':i
				}).inject(mooqueeNav);
				mooqueeNav.set(\'html\',mooqueeNav.get(\'html\')+\' \');
			}
			mooqueeNav.inject($(\'mooquee'.$objSettings->id.'\'));';
		}

$strJS .= '
		objMooquee'.$objSettings->id.' = new Mooquee({
			element:\'mooquee'.$objSettings->id.'\',
			trans:{\'tin\':\''.$objSettings->mooquee4wardTransin.'\', \'tout\':\''.$objSettings->mooquee4wardTransout.'\'},
			duration:'.$objSettings->mooquee4wardDuration.',
			pause: '.$objSettings->mooquee4wardPause.',
			firstitem:'.$objSettings->mooquee4wardFirstitem.',
			pauseOnHover:'.(($objSettings->mooquee4wardPauseOnHover == '1') ? 'true' : 'false').',
			transition:\''.$trans.'\',
			';

		if($objSettings->mooquee4wardShowNav)
		{

$strJS .= '			onTransitionComplete: function(ci,pi){
				var els = $$(\'#mooquee'.$objSettings->id.' div.mooqueeNav a\');
				els.removeClass(\'active\');
				els[ci].addClass(\'active\');
			},';
		}

$strJS .= 'startOnLoad:true
		});

	});
	</script>
	';

		return $strJS;
	}
}

?>
