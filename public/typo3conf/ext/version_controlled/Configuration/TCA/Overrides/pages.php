<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'version_controlled',
    'Configuration/TypoScript/BackendLayouts.tsconfig',
    'Ocular backend layouts'
);
