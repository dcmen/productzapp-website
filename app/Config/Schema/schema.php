<?php
/**
  * Migration file.  If you do not have paypal_ipn installed on your system. please use the ipn schema file.
  */
class PaypalIpnSchema extends CakeSchema {
  public function before($event = array()) {
    return true;
  }

  public function after($event = array()) {
  }

  public $instant_payment_notifications = array(
    'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'pay_key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'sell_file_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
    'valid' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
    'notify_version' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => 'IPN Version Number', 'charset' => 'utf8'),
    'verify_sign' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Encrypted string used to verify the authenticityof the tansaction', 'charset' => 'utf8'),
    'test_ipn' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
    'address_city' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'comment' => 'City of customers address', 'charset' => 'utf8'),
    'address_country' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => 'Country of customers address', 'charset' => 'utf8'),
    'address_country_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 2, 'collate' => 'utf8_unicode_ci', 'comment' => 'Two character ISO 3166 country code', 'charset' => 'utf8'),
    'address_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128, 'collate' => 'utf8_unicode_ci', 'comment' => 'Name used with address (included when customer provides a Gift address)', 'charset' => 'utf8'),
    'address_state' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'comment' => 'State of customer address', 'charset' => 'utf8'),
    'address_status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'confirmed/unconfirmed', 'charset' => 'utf8'),
    'address_street' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'comment' => 'Customer\'s street address', 'charset' => 'utf8'),
    'address_zip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'Zip code of customer\'s address', 'charset' => 'utf8'),
    'first_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => 'Customer\'s first name', 'charset' => 'utf8'),
    'last_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => 'Customer\'s last name', 'charset' => 'utf8'),
    'payer_business_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Customer\'s company name, if customer represents a business', 'charset' => 'utf8'),
    'payer_email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Customer\'s primary email address. Use this email to provide any credits', 'charset' => 'utf8'),
    'payer_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 13, 'collate' => 'utf8_unicode_ci', 'comment' => 'Unique customer ID.', 'charset' => 'utf8'),
    'payer_status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'verified/unverified', 'charset' => 'utf8'),
    'contact_phone' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'Customer\'s telephone number.', 'charset' => 'utf8'),
    'residence_country' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 2, 'collate' => 'utf8_unicode_ci', 'comment' => 'Two-Character ISO 3166 country code', 'charset' => 'utf8'),
    'business' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Email address or account ID of the payment recipient (that is, the merchant). Equivalent to the values of receiver_email (If payment is sent to primary account) and business set in the Website Payment HTML.', 'charset' => 'utf8'),
    'item_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Item name as passed by you, the merchant. Or, if not passed by you, as entered by your customer. If this is a shopping cart transaction, Paypal will append the number of the item (e.g., item_name_1,item_name_2, and so forth).', 'charset' => 'utf8'),
    'item_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Pass-through variable for you to track purchases. It will get passed back to you at the completion of the payment. If omitted, no variable will be passed back to you.', 'charset' => 'utf8'),
    'quantity' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Quantity as entered by your customer or as passed by you, the merchant. If this is a shopping cart transaction, PayPal appends the number of the item (e.g., quantity1,quantity2).', 'charset' => 'utf8'),
    'receiver_email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Primary email address of the payment recipient (that is, the merchant). If the payment is sent to a non-primary email address on your PayPal account, the receiver_email is still your primary email.', 'charset' => 'utf8'),
    'receiver_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 13, 'collate' => 'utf8_unicode_ci', 'comment' => 'Unique account ID of the payment recipient (i.e., the merchant). This is the same as the recipients referral ID.', 'charset' => 'utf8'),
    'custom' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'comment' => 'Custom value as passed by you, the merchant. These are pass-through variables that are never presented to your customer.', 'charset' => 'utf8'),
    'invoice' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'comment' => 'Pass through variable you can use to identify your invoice number for this purchase. If omitted, no variable is passed back.', 'charset' => 'utf8'),
    'memo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1000, 'collate' => 'utf8_unicode_ci', 'comment' => 'Memo as entered by your customer in PayPal Website Payments note field.', 'charset' => 'utf8'),
    'option_name1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => 'Option name 1 as requested by you', 'charset' => 'utf8'),
    'option_name2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => 'Option 2 name as requested by you', 'charset' => 'utf8'),
    'option_selection1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'comment' => 'Option 1 choice as entered by your customer', 'charset' => 'utf8'),
    'option_selection2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'comment' => 'Option 2 choice as entered by your customer', 'charset' => 'utf8'),
    'tax' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Amount of tax charged on payment'),
    'auth_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 19, 'collate' => 'utf8_unicode_ci', 'comment' => 'Authorization identification number', 'charset' => 'utf8'),
    'auth_exp' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'Authorization expiration date and time, in the following format: HH:MM:SS DD Mmm YY, YYYY PST', 'charset' => 'utf8'),
    'auth_amount' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'Authorization amount'),
    'auth_status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'Status of authorization', 'charset' => 'utf8'),
    'num_cart_items' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'If this is a PayPal shopping cart transaction, number of items in the cart'),
    'parent_txn_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 19, 'collate' => 'utf8_unicode_ci', 'comment' => 'In the case of a refund, reversal, or cancelled reversal, this variable contains the txn_id of the original transaction, while txn_id contains a new ID for the new transaction.', 'charset' => 'utf8'),
    'payment_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'Time/date stamp generated by PayPal, in the following format: HH:MM:SS DD Mmm YY, YYYY PST', 'charset' => 'utf8'),
    'payment_status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'Payment status of the payment', 'charset' => 'utf8'),
    'payment_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'comment' => 'echeck/instant', 'charset' => 'utf8'),
    'pending_reason' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'This variable is only set if payment_status=pending', 'charset' => 'utf8'),
    'reason_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'This variable is only set if payment_status=reversed', 'charset' => 'utf8'),
    'remaining_settle' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'Remaining amount that can be captured with Authorization and Capture'),
    'shipping_method' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => 'The name of a shipping method from the shipping calculations section of the merchants account profile. The buyer selected the named shipping method for this transaction', 'charset' => 'utf8'),
    'shipping' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Shipping charges associated with this transaction. Format unsigned, no currency symbol, two decimal places'),
    'transaction_entity' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'Authorization and capture transaction entity', 'charset' => 'utf8'),
    'txn_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 19, 'collate' => 'utf8_unicode_ci', 'comment' => 'A unique transaction ID generated by PayPal', 'charset' => 'utf8'),
    'txn_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => 'cart/express_checkout/send-money/virtual-terminal/web-accept', 'charset' => 'utf8'),
    'exchange_rate' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Exchange rate used if a currency conversion occured'),
    'mc_currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'utf8_unicode_ci', 'comment' => 'Three character country code. For payment IPN notifications, this is the currency of the payment, for non-payment subscription IPN notifications, this is the currency of the subscription.', 'charset' => 'utf8'),
    'mc_fee' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Transaction fee associated with the payment, mc_gross minus mc_fee equals the amount deposited into the receiver_email account. Equivalent to payment_fee for USD payments. If this amount is negative, it signifies a refund or reversal, and either ofthose p'),
    'mc_gross' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Full amount of the customer\'s payment'),
    'mc_handling' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Total handling charge associated with the transaction'),
    'mc_shipping' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Total shipping amount associated with the transaction'),
    'payment_fee' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'USD transaction fee associated with the payment'),
    'payment_gross' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Full USD amount of the customers payment transaction, before payment_fee is subtracted'),
    'settle_amount' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Amount that is deposited into the account\'s primary balance after a currency conversion'),
    'settle_currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'utf8_unicode_ci', 'comment' => 'Currency of settle amount. Three digit currency code', 'charset' => 'utf8'),
    'auction_buyer_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => 'The customer\'s auction ID.', 'charset' => 'utf8'),
    'auction_closing_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'The auction\'s close date. In the format: HH:MM:SS DD Mmm YY, YYYY PSD', 'charset' => 'utf8'),
    'auction_multi_item' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'The number of items purchased in multi-item auction payments'),
    'for_auction' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'comment' => 'This is an auction payment - payments made using Pay for eBay Items or Smart Logos - as well as send money/money request payments with the type eBay items or Auction Goods(non-eBay)', 'charset' => 'utf8'),
    'subscr_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'Start date or cancellation date depending on whether txn_type is subcr_signup or subscr_cancel', 'charset' => 'utf8'),
    'subscr_effective' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'Date when a subscription modification becomes effective', 'charset' => 'utf8'),
    'period1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'comment' => '(Optional) Trial subscription interval in days, weeks, months, years (example a 4 day interval is 4 D', 'charset' => 'utf8'),
    'period2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'comment' => '(Optional) Trial period', 'charset' => 'utf8'),
    'period3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'comment' => 'Regular subscription interval in days, weeks, months, years', 'charset' => 'utf8'),
    'amount1' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Amount of payment for Trial period 1 for USD'),
    'amount2' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Amount of payment for Trial period 2 for USD'),
    'amount3' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Amount of payment for regular subscription  period 1 for USD'),
    'mc_amount1' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Amount of payment for trial period 1 regardless of currency'),
    'mc_amount2' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Amount of payment for trial period 2 regardless of currency'),
    'mc_amount3' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'comment' => 'Amount of payment for regular subscription period regardless of currency'),
    'recurring' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_unicode_ci', 'comment' => 'Indicates whether rate recurs (1 is yes, blank is no)', 'charset' => 'utf8'),
    'reattempt' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_unicode_ci', 'comment' => 'Indicates whether reattempts should occur on payment failure (1 is yes, blank is no)', 'charset' => 'utf8'),
    'retry_at' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'Date PayPal will retry a failed subscription payment', 'charset' => 'utf8'),
    'recur_times' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'The number of payment installations that will occur at the regular rate'),
    'username' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'comment' => '(Optional) Username generated by PayPal and given to subscriber to access the subscription', 'charset' => 'utf8'),
    'password' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 24, 'collate' => 'utf8_unicode_ci', 'comment' => '(Optional) Password generated by PayPal and given to subscriber to access the subscription (Encrypted)', 'charset' => 'utf8'),
    'subscr_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 19, 'collate' => 'utf8_unicode_ci', 'comment' => 'ID generated by PayPal for the subscriber', 'charset' => 'utf8'),
    'case_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'Case identification number', 'charset' => 'utf8'),
    'case_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'complaint/chargeback', 'charset' => 'utf8'),
    'case_creation_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_unicode_ci', 'comment' => 'Date/Time the case was registered', 'charset' => 'utf8'),
    'log_default_shipping_address_in_transaction' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
    'action_type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'ipn_notification_url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'charset' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'transaction_type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'cancel_url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'sender_email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'fees_payer' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'return_url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'reverse_all_parallel_payments_on_error' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
    'status' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'payment_request_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'ip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 16, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'raw' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'pay_key' => array('column' => 'pay_key', 'unique' => 0)),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
  );

  public $paypal_items = array(
    'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'instant_payment_notification_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'item_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'item_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'quantity' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'mc_gross' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
    'mc_shipping' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
    'mc_handling' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
    'tax' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
    'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
  );
}