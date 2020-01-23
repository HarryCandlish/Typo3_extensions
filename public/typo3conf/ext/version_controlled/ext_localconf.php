<?php
if (!defined('TYPO3_MODE')) {
        die('Access denied.');
}
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\IndexedSearch\\Controller\\SearchController'] = array(
   'className' => 'Ocular\\VersionControlled\\Controller\\SearchController'
);
