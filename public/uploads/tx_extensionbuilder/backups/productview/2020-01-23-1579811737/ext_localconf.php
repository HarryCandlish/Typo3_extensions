<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Product.Productview',
            'Products',
            [
                'Product' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'Product' => 'create, update, delete'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    products {
                        iconIdentifier = productview-plugin-products
                        title = LLL:EXT:productview/Resources/Private/Language/locallang_db.xlf:tx_productview_products.name
                        description = LLL:EXT:productview/Resources/Private/Language/locallang_db.xlf:tx_productview_products.description
                        tt_content_defValues {
                            CType = list
                            list_type = productview_products
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'productview-plugin-products',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:productview/Resources/Public/Icons/user_plugin_products.svg']
			);
		
    }
);
