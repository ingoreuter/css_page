<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// Register Plugin
//\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
//	$_EXTKEY, 
//	'Pi1', 
//	'LLL:EXT:css_page/Resources/Private/Language/locallang_be.xlf:tx_csspage.plugin.name'
//); 


	// Static template
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'CSS page properties');


	// Add field to TCA
$TCA['pages']['columns'] += array(	
	'tx_csspage_css' => array(
		'exclude' => 1,
		'label' => '', // Heading goes heere!
		'config' => array(
			'type' => 'flex',
			'ds' => array(
				'default' => 'FILE:EXT:css_page/Configuration/FlexForm/Setup.xml',
			)
		)
	)
);

	// Display field in all content element types
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'pages', 
	'
	--div--;LLL:EXT:css_page/Resources/Private/Language/locallang_be.xlf:tx_csspage.be.tabname,
	tx_csspage_css
	'
);


// $GLOBALS['TYPO3_DB']->debugOutput = true;


?>