<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Product.Productview',
            'Products',
            'Products'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('productview', 'Configuration/TypoScript', 'Product Overview');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productview_domain_model_category', 'EXT:productview/Resources/Private/Language/locallang_csh_tx_productview_domain_model_category.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productview_domain_model_category');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productview_domain_model_product', 'EXT:productview/Resources/Private/Language/locallang_csh_tx_productview_domain_model_product.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productview_domain_model_product');

    }
);
