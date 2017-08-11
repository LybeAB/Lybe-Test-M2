<?php
namespace Page\Acceptance;

class Catalog
{
    public static $CATEGORY_URL = 'sortiment.html';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    public static $categoryFirstProduct = 'ol.product-items .product-item-info a';
    public static $productBody = '.catalog-product-view';
    public static $addToCartForm = '#product_addtocart_form';
    public static $successMessage = '.message-success';

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

}
