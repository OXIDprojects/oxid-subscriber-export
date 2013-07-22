<?php

/**
 * Module information
 *
 * @author Jonathan Ströbele (planungsbuero.de)
 */
$aModule = array(
    'id'           => 'pbi_mailexport',
    'title'        => 'PBI Newsletter Subscriber Export',
    'description'  => 'Export newsletter subscribers with specified subscription status.',
    'thumbnail'    => 'pbi.png',
	'url'		   => 'http://planungsbuero.de/',
	'email'		   => 'support@planungsbuero.de',
    'version'      => '1.0',
    'author'       => 'pbi planungsbüro INTERNET GmbH',
    'extend'       => array(),

    'files'        => array(

		// Admin
		'pbi_mailexport' => 'pbi_mailexport/application/controllers/admin/pbi_mailexport.php',

	),

    'templates' => array(
        // Admin
		'pbi_mailexport.tpl' => 'pbi_mailexport/application/views/admin/tpl/pbi_mailexport.tpl',
	),
);
