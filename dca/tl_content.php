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


/**
 * Add palette
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['mooquee4ward'] = '{type_legend},type,headline;{mooquee4wardLegend},mooquee4wardTransin,mooquee4wardTransout,mooquee4wardTransition1,mooquee4wardTransition2,mooquee4wardDuration,mooquee4wardPause,mooquee4wardSize,mooquee4wardFirstitem,mooquee4wardPauseOnHover,mooquee4wardShowNav;{source_legend},multiSRC;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_content']['palettes']['mooquee4wardStart'] = '{type_legend},type;{mooquee4wardLegend},mooquee4wardTransin,mooquee4wardTransout,mooquee4wardTransition1,mooquee4wardTransition2,mooquee4wardDuration,mooquee4wardPause,mooquee4wardSize,mooquee4wardPauseOnHover,mooquee4wardShowNav;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['mooquee4wardEnd'] = '{type_legend},type;{expert_legend:hide},cssID,space';


$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardDuration'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardDuration'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'default'				  => '1000',
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit','tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardPause'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardPause'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'default'				  => '1500',
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50','rgxp'=>'digit')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardSize'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardSize'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'default'				  => serialize(array('400','20')),
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50','size'=>2,'multiple'=>true)
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardTransin'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransin'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'default'				  => 'fade',
	'options'				  => array('left'=>'left','right'=>'right','up'=>'up','down'=>'down','fade'=>'fade','none'=>'none'),
	'reference'				  => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransitions'],
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardTransout'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransout'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'default'				  => 'left',
	'options'				  => array('left'=>'left','right'=>'right','up'=>'up','down'=>'down','fade'=>'fade','none'=>'none'),
	'reference'				  => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransitions'],
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardTransition1'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransition1'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'default'				  => 'quad',
	'options'				  => array('linear'=>'linear','quad'=>'quad','cubic'=>'cubic','quart'=>'quart','quint'=>'quint',
									   'expo'=>'expo','circ'=>'circ','sine'=>'sine','back'=>'back','bounce'=>'bounce','elastic'=>'elastic'),
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardTransition2'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransition2'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'default'				  => 'inOut',
	'options'				  => array('in'=>'in','out'=>'out','inOut'=>'inOut'),
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardFirstitem'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardFirstitem'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'				  => array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','random'=>'random'),
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardPauseOnHover'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardPauseOnHover'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'default'				  => '0',
	'eval'                    => array('mandatory'=>false,'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['mooquee4wardShowNav'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['mooquee4wardShowNav'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'default'				  => '1',
	'eval'                    => array('mandatory'=>false,'tl_class'=>'w50')
);


// callback to generate endelement automatically
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('tl_content_mooquee4ward','insertElem');
$GLOBALS['TL_DCA']['tl_content']['config']['ondelete_callback'][] = array('tl_content_mooquee4ward','deleteElem');

class tl_content_mooquee4ward extends System 
{
	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
	}
	
	/**
	 * Insert the start/end-element if a element is created
	 */
	public function insertElem($dc)
	{
		// only for mooquee4ward elements
		if($dc->activeRecord->type != 'mooquee4wardStart' && $dc->activeRecord->type != 'mooquee4wardEnd') return;
		
		// only if theres no related element
		if($dc->activeRecord->mooquee4wardRelatedCE != 0) return;
		
		
		if($dc->activeRecord->type == 'mooquee4wardStart')
		{
			// create end-element
			$objErg = $this->Database->prepare('INSERT INTO tl_content %s')
							->set(array(
								'pid' 		=> $dc->activeRecord->pid,
								'type'		=> 'mooquee4wardEnd',
								'tstamp' 	=> time(),
								'sorting' 	=> $dc->activeRecord->sorting+1,
								'mooquee4wardRelatedCE' => $dc->id
							))->execute();
		}
		else
		{
			// create start-element
			$objErg = $this->Database->prepare('INSERT INTO tl_content %s')
							->set(array(
								'pid' 		=> $dc->activeRecord->pid,
								'type'		=> 'mooquee4wardStart',
								'tstamp' 	=> time(),
								'sorting' 	=> $dc->activeRecord->sorting-1,
								'mooquee4wardDuration' 	=> 2000,
								'mooquee4wardPause' 	=> 500,
								'mooquee4wardFirstitem' => 0,
								'mooquee4wardSize'		=> serialize(array('400','200')),
								'mooquee4wardTransin'	=> 'left',
								'mooquee4wardTransout'	=> 'fade',
								'mooquee4wardTransition1'=> 'quad',
								'mooquee4wardTransition2'=> 'inOut',
								'mooquee4wardPauseOnHover'=> '0',
								'mooquee4wardShowNav'	=> '0',
								'mooquee4wardRelatedCE' => $dc->id
							))->execute();
		} 						
		$this->Database->prepare('UPDATE tl_content SET mooquee4wardRelatedCE=? WHERE id=?')
					->execute($objErg->insertId,$dc->id);
	}
	
	
	/**
	 * Also delete the related start/end element
	 */
	public function deleteElem($dc)
	{
		// only for mooquee4ward elements
		if($dc->activeRecord->type != 'mooquee4wardStart' && $dc->activeRecord->type != 'mooquee4wardEnd') return;
		
		if($dc->activeRecord->id > 0)
		{
			$this->Database->prepare('DELETE FROM tl_content WHERE pid=? AND mooquee4wardRelatedCE=? LIMIT 1')
					->execute($dc->activeRecord->pid,$dc->activeRecord->id);
		}
	}
} 

?>