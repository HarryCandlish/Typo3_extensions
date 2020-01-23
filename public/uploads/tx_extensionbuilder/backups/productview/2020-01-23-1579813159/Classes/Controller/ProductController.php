<?php
namespace Product\Productview\Controller;


/***
 *
 * This file is part of the "Product Overview" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 
 *
 ***/
/**
 * ProductController
 */
class ProductController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * productRepository
     * 
     * @var \Product\Productview\Domain\Repository\ProductRepository
     * @inject
     */
    protected $productRepository = null;

    /**
     * @param \Product\Productview\Domain\Repository\ProductRepository $ProductRepository
     */
    public function injectProductRepository(\Product\Productview\Domain\Repository\ProductRepository $ProductRepository)
    {
        $this->productRepository = $ProductRepository;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $products = $this->productRepository->findAll();
        $this->view->assign('products', $products);
    }

    /**
     * action show
     * 
     * @param \Product\Productview\Domain\Model\Product $product
     * @return void
     */
    public function showAction(\Product\Productview\Domain\Model\Product $product)
    {
        $this->view->assign('product', $product);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \Product\Productview\Domain\Model\Product $newProduct
     * @return void
     */
    public function createAction(\Product\Productview\Domain\Model\Product $newProduct)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productRepository->add($newProduct);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Product\Productview\Domain\Model\Product $product
     * @ignorevalidation $product
     * @return void
     */
    public function editAction(\Product\Productview\Domain\Model\Product $product)
    {
        $this->view->assign('product', $product);
    }

    /**
     * action update
     * 
     * @param \Product\Productview\Domain\Model\Product $product
     * @return void
     */
    public function updateAction(\Product\Productview\Domain\Model\Product $product)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productRepository->update($product);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Product\Productview\Domain\Model\Product $product
     * @return void
     */
    public function deleteAction(\Product\Productview\Domain\Model\Product $product)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productRepository->remove($product);
        $this->redirect('list');
    }
}
