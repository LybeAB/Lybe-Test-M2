<?php
namespace Page\Acceptance;

class Checkout
{
    public static $URL = '/checkout/';
    public static $CART_URL = '/checkout/cart/';
    public static $SUCCESS_URL = '/checkout/onepage/success';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    //public static $radioTypeGuest = '#login:guest';
    //public static $continueButton = 'button#onepage-guest-register-button';

    public static $billingFirstname = 'firstname';
    public static $billingLastname = 'lastname';
    public static $billingEmail = 'username';
    public static $billingCountryId = 'country_id';
    public static $billingStreet1 = 'street[0]';
    public static $billingPostcode = 'postcode';
    public static $billingCity = 'city';
    public static $billingTelephone = 'telephone';

    //public static $billingAddressContainer = '#billing-buttons-container';

    public static $shippingButtonsContainer = '#shipping-method-buttons-container';
    public static $paymentButtonsContainer = '.payment-method-content';
    public static $checkoutReviewContainer = 'action.checkout';

    public static $shippingMethodInput = '#s_method_flatrate';
    public static $shippingMethod = '';
    public static $paymentMethod = '#p_method_cashondelivery';

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

}
