<?php

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    'ContentMooquee4ward'      => 'system/modules/mooquee4ward/ContentMooquee4ward.php',
    'ContentMooquee4wardEnd'   => 'system/modules/mooquee4ward/ContentMooquee4wardEnd.php',
    'ContentMooquee4wardStart' => 'system/modules/mooquee4ward/ContentMooquee4wardStart.php',
    'ModuleMooquee4ward'       => 'system/modules/mooquee4ward/ModuleMooquee4ward.php',
    'Mooquee4ward'             => 'system/modules/mooquee4ward/Mooquee4ward.php',
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'ce_mooquee4ward' => 'system/modules/mooquee4ward/templates',
    'ce_mooquee4ward_end' => 'system/modules/mooquee4ward/templates',
    'ce_mooquee4ward_start' => 'system/modules/mooquee4ward/templates',
    'mod_mooquee4ward' => 'system/modules/mooquee4ward/templates',
));
