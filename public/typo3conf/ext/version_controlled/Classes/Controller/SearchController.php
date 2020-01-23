<?php
namespace Ocular\VersionControlled\Controller;

/**
 * SearchController
 */
class SearchController extends \TYPO3\CMS\IndexedSearch\Controller\SearchController {

    /**
     * Overwrite search form action to handle GET requests instead of just POST requests
     *
     * @param array $search The search data / params
     */
    public function formAction($search = [])
    {
        if ($search['sword']){
                $this->redirect( 'search', 'Search', 'IndexedSearch', array('search'=>$search) );
        }
        parent::formAction($search);
    }
}
