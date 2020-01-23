<?php

defined('TYPO3_MODE') or die();

// Only if the news extension is installed
if (!TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('news')) {
    return;
}

// Labels
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['title']['label'] = 'Title';
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['archive']['label'] = 'Date to expire (optional)';
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['datetime']['label'] = 'Date to become visible';
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['fal_media']['label'] = 'Hero image';
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['path_segment']['label'] = 'URL Slug';
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['content_elements']['label'] = 'Content';

// Palettes
$GLOBALS['TCA']['tx_news_domain_model_news']['palettes']['paletteForSeo']['showitem'] = 'keywords,description,path_segment';
$GLOBALS['TCA']['tx_news_domain_model_news']['palettes']['paletteForCategories']['showitem'] = 'fal_media,categories';
$GLOBALS['TCA']['tx_news_domain_model_news']['palettes']['paletteForTitleAndTeaser']['showitem'] = 'title,teaser';
$GLOBALS['TCA']['tx_news_domain_model_news']['palettes']['paletteForPublicationAndExpirationDates']['showitem'] = 'datetime,archive';

// Limit the hero image to actual images only
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['fal_media']['config']['overrideChildTca']['columns']['uid_local']['config']['appearance']['elementBrowserAllowed'] = 'gif,jpg,jpeg,bmp,png';
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['fal_media']['config']['maxitems'] = 1;

// Set the default behaviour of the hero image to appear in both list and show views. Default 0
$GLOBALS['TCA']['sys_file_reference']['columns']['showinpreview']['config']['default'] = 1;

// Hide the option that lets the user say where the hero image should appear
$GLOBALS['TCA']['sys_file_reference']['columns']['showinpreview']['config']['type'] = 'passthrough';
unset($GLOBALS['TCA']['sys_file_reference']['columns']['showinpreview']['config']['renderType']);

// Layout of backend editor
$GLOBALS['TCA']['tx_news_domain_model_news']['types']['0'] = [
    'showitem' => '
        --div--;
            Article,
                title,
                teaser,
                --palette--;;
                    paletteForCategories,
                content_elements,
        --div--;
            SEO,
                --palette--;;
                    paletteForSeo,
        --div--;
            Access,
                hidden,
                --palette--;
                    Publication and expiration dates;
                        paletteForPublicationAndExpirationDates
    '
];
