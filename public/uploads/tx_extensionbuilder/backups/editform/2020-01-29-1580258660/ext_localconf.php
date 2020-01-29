<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'EditForm.Editform',
            'Editform',
            [
                'EditForm' => 'list, show, new, create, edit, update, delete, '
            ],
            // non-cacheable actions
            [
                'EditForm' => 'create, update, delete, '
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    editform {
                        iconIdentifier = editform-plugin-editform
                        title = LLL:EXT:editform/Resources/Private/Language/locallang_db.xlf:tx_editform_editform.name
                        description = LLL:EXT:editform/Resources/Private/Language/locallang_db.xlf:tx_editform_editform.description
                        tt_content_defValues {
                            CType = list
                            list_type = editform_editform
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'editform-plugin-editform',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:editform/Resources/Public/Icons/user_plugin_editform.svg']
			);
		
    }
);
