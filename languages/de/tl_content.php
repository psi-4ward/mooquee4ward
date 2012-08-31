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

$GLOBALS['TL_LANG']['tl_content']['mooquee4wardLegend'] = "Mooquee4ward Einstellungen";

$GLOBALS['TL_LANG']['tl_content']['useMooquee4ward']		  = array('Mooquee4ward','Hier kann der Mooquee4ward-Slider für dieses Element aktiviert werden.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardDuration'] 	  = array('Dauer','Hier können Sie die Dauer des Effekts in Millisekunden festlegen.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardPause'] 		  = array('Warten','Es wird eine in Millisekunden angegebene Pause zwischen den Slides eingefügt.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardSize'] 		  = array('Breite / Höhe','Legen Sie hier die Breite und Höhe in Pixel für des Laufbands fest.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardFirstitem'] 	  = array('Startbild','Hier kann das Startbild festgelegt werden.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransin'] 	  = array('Einblendeeffekt','Wählen Sie hier den Effekt für die Einblendung.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransout'] 	  = array('Ausblendeeffekt','Wählen Sie hier den Effekt für die Ausblendung.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardPauseOnHover'] = array('Pause bei Mausover','Wird die Maus über den Slider gefahren, wird der Effekt angehalten.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardShowNav'] 	  = array('Navigation anzeigen','Zeigt eine Navigation um zwischen den Slides zu wechseln.');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransition1']  = array('Transition','Hier können Sie die Berechnungsgrundlage des Effektes wählen. Mehr unter http://mootools.net/docs/core/Fx/Fx.Transitions');
$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransition2']  = array('Transition-Eigenschaft','Hier wird die Transition-Kurve angewandt.');

$GLOBALS['TL_LANG']['tl_content']['mooquee4wardTransitions'] = array
(
	'up'	=> 'nach oben',
	'down'	=> 'nach unten',
	'left'	=> 'nach links',
	'right'	=> 'nach rechts',
	'fade'	=> 'überblenden',
	'none'	=> 'kein Effekt'
);

?>