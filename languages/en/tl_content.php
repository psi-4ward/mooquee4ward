<?php
if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * @package    Mooquee4ward
 * @license    LGPL 
 * @filesource
 */

$GLOBALS['TL_LANG']['tl_content']['mooquee4wardLegend'] = "Mooquee4ward config";

$GLOBALS['TL_LANG']['tl_content']['useMooquee4ward']		  = array('Mooquee4ward','Activate the mooquee4ward slider for this element.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardDuration'] 	  = array('Duration','Set the effekt duration in milliseconds.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardPause'] 		  = array('Pause','Make a break of given milliseconds between the images.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardSize'] 		  = array('Width / Height','Set the width and height of the images in pixel.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardFirstitem'] 	  = array('First image','You can choos the first image.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransin'] 	  = array('Fadein-effect','Here you can choose the effect for the beginning.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransout'] 	  = array('Fedout-effect','Here you can choose the effect for the end.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardPauseOnHover'] = array('Pause on mousover','Move the mouse over the image to pause the slideshow.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardShowNav'] 	  = array('Show the navigation','Shows a little navigation to switch between the images.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransition1']  = array('Transition','Choose the mathematic base for the effect. More at http://mootools.net/docs/core/Fx/Fx.Transitions');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransition2']  = array('Transition-property','Choose where where to apply the curve.');

$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransitions'] = array
(
	'up'	=> 'upward',
	'down'	=> 'downward',
	'left'	=> 'leftward',
	'right'	=> 'rightward',
	'fade'	=> 'fade',
	'none'	=> 'no effect'
);

?>