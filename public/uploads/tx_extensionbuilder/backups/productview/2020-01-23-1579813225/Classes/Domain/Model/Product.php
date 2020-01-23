<?php
namespace Product\Productview\Domain\Model;


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
 * product overview
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     * 
     * @var string
     */
    protected $name = '';

    /**
     * price
     * 
     * @var string
     */
    protected $price = '';

    /**
     * startDate
     * 
     * @var \DateTime
     */
    protected $startDate = null;

    /**
     * endDate
     * 
     * @var \DateTime
     */
    protected $endDate = null;

    /**
     * inStore
     * 
     * @var bool
     */
    protected $inStore = 0;

    /**
     * image
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $image = null;

    /**
     * categories
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Product\Productview\Domain\Model\Category>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $categories = null;

    /**
     * sorting
     * 
     * @var int
     */
    protected $sorting = 0;

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the price
     * 
     * @return string $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the price
     * 
     * @param string $price
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Adds a Category
     * 
     * @param \Product\Productview\Domain\Model\Category $category
     * @return void
     */
    public function addCategory(\Product\Productview\Domain\Model\Category $category)
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a Category
     * 
     * @param \Product\Productview\Domain\Model\Category $categoryToRemove The Category to be removed
     * @return void
     */
    public function removeCategory(\Product\Productview\Domain\Model\Category $categoryToRemove)
    {
        $this->categories->detach($categoryToRemove);
    }

    /**
     * Returns the categories
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Product\Productview\Domain\Model\Category> $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Sets the categories
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Product\Productview\Domain\Model\Category> $categories
     * @return void
     */
    public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the startDate
     * 
     * @return \DateTime $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the startDate
     * 
     * @param \DateTime $startDate
     * @return void
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Returns the endDate
     * 
     * @return \DateTime $endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Sets the endDate
     * 
     * @param \DateTime $endDate
     * @return void
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Returns the inStore
     * 
     * @return bool inStore
     */
    public function getInStore()
    {
        return $this->inStore;
    }

    /**
     * Sets the inStore
     * 
     * @param int $inStore
     * @return void
     */
    public function setInStore($inStore)
    {
        $this->inStore = $inStore;
    }

    /**
     * Returns the image
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the sorting
     * 
     * @return int $sorting
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * Sets the sorting
     * 
     * @param int $sorting
     * @return void
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }
}
