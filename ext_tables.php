<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Extension::registerPlugin ( $_EXTKEY, 'Pi1', ' A timetracking extension (Administation)' );
Tx_Extbase_Utility_Extension::registerPlugin ( $_EXTKEY, 'Pi2', ' A timetracking extension (User)' );
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Timetracking');

If ( TYPO3_MODE === 'BE' )
    Tx_Extbase_Utility_Extension::registerModule ( $_EXTKEY,
	                                            'web',
	                                            'tx_timekeeping_m1',
	                                            '',
	                                            Array ( 'Backend' => 'index' ),
	                                            Array ( 'access' => 'user,group',
	                                                    'icon'   => 'EXT:timekeeping/ext_icon.gif',
	                                                    'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml' ) );

t3lib_extMgm::addLLrefForTCAdescr       ( 'tx_timekeeping_domain_model_family',
                                          'EXT:timekeeping/Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_family.xml' );
t3lib_extMgm::allowTableOnStandardPages ( 'tx_timekeeping_domain_model_family');

$TCA['tx_timekeeping_domain_model_family'] = array (
	'ctrl' => array (
		'title'                    => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_family',
		'label'                    => 'name',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
		'versioningWS'             => 2,
		'versioning_followPages'   => TRUE,
		'origUid'                  => 't3_origuid',
		'delete'                   => 'deleted',
		'enablecolumns'            => array ( 'disabled' => 'hidden' ),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Family.php',
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_timekeeping_domain_model_family.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr       ( 'tx_timekeeping_domain_model_role',
                                          'EXT:timekeeping/Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_role.xml');
t3lib_extMgm::allowTableOnStandardPages ( 'tx_timekeeping_domain_model_role' );
$TCA['tx_timekeeping_domain_model_role'] = array (
	'ctrl' => array (
		'title'                    => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_role',
		'label'                    => 'name',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
		'versioningWS'             => 2,
		'versioning_followPages'   => TRUE,
		'origUid'                  => 't3_origuid',
		'delete'                   => 'deleted',
		'enablecolumns'            => array ( 'disabled' => 'hidden' ),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Role.php',
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_timekeeping_domain_model_role.gif'
	)
);


t3lib_extMgm::addLLrefForTCAdescr       ( 'tx_timekeeping_domain_model_assignment',
                                          'EXT:timekeeping/Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_assignment.xml' );
t3lib_extMgm::allowTableOnStandardPages ( 'tx_timekeeping_domain_model_assignment' );
$TCA['tx_timekeeping_domain_model_assignment'] = array (
	'ctrl' => array (
		'title'                    => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_assignment',
		'label'                    => 'user',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
		'versioningWS'             => 2,
		'versioning_followPages'   => TRUE,
		'origUid'                  => 't3_origuid',
		'delete'                   => 'deleted',
		'enablecolumns'            => array ( 'disabled' => 'hidden' ),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Assignment.php',
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_timekeeping_domain_model_assignment.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr       ( 'tx_timekeeping_domain_model_timeunit',
                                          'EXT:timekeeping/Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_timeunit.xml' );
t3lib_extMgm::allowTableOnStandardPages ( 'tx_timekeeping_domain_model_timeunit' );
$TCA['tx_timekeeping_domain_model_timeunit'] = array (
	'ctrl' => array (
		'title'                    => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_timeunit',
		'label'                    => 'description',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
		'versioningWS'             => 2,
		'versioning_followPages'   => TRUE,
		'origUid'                  => 't3_origuid',
		'delete'                   => 'deleted',
		'enablecolumns'            => array( 'disabled' => 'hidden' ),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Timeunit.php',
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_timekeeping_domain_model_timeunit.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_timekeeping_domain_model_requiredhours', 'EXT:timekeeping/Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_requiredhours.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_timekeeping_domain_model_requiredhours');
$TCA['tx_timekeeping_domain_model_requiredhours'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_requiredhours',
		'label' => 'hours',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/RequiredHours.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_timekeeping_domain_model_requiredhours.gif'
	),
);


?>