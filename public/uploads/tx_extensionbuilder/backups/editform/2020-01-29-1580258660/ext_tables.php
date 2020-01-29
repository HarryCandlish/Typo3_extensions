<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'EditForm.Editform',
            'Editform',
            'Edit Form'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('editform', 'Configuration/TypoScript', 'Edit Form');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_editform_domain_model_editform', 'EXT:editform/Resources/Private/Language/locallang_csh_tx_editform_domain_model_editform.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_editform_domain_model_editform');

    }
);
