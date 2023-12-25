<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Notification route
    |--------------------------------------------------------------------------
    |
    | Here you may specify the route to the notification where Payapl sends  
    | IPN signals. The specified route has an /api prefix. 
    | For example, for /paypal/notification, the full path will be /api/paypal/notification.
    |
    */
    'notification_route' => '/paypal/notification',
    /*
    |--------------------------------------------------------------------------
    | Mode
    |--------------------------------------------------------------------------
    |
    | Here you may specify the Paypal endpoint mode. 
    | Possible values: dev, prod. 
    | Use 'dev' for testing and 'prod' for a live application.
    |
    */
    'mode' => env('PAYPAL_MODE', 'dev'),
    /*
    |--------------------------------------------------------------------------
    | Email Paypal
    |--------------------------------------------------------------------------
    |
    | Here you may specify the paypal seller email where funds will be transfered
    |
    */
    'paypal_email' => env('PAYPAL_EMAIL', ''),
    /*
    |--------------------------------------------------------------------------
    | Testing transaction URL
    |--------------------------------------------------------------------------
    |
    | This is the URL address that initiates the test transaction. 
    |
    */
    'testing_transaction_url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
    /*
    |--------------------------------------------------------------------------
    | Production transaction URL
    |--------------------------------------------------------------------------
    |
    | This is the URL address that initiates the real transaction.
    |
    */
    'production_transaction_url' => 'https://www.paypal.com/cgi-bin/webscr',
    /*
    |--------------------------------------------------------------------------
    | Testing IPN verification URL
    |--------------------------------------------------------------------------
    |
    | This is the URL of sandbox IPN verification
    |
    */
    'testing_ipn_url' => 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr',
    /*
    |--------------------------------------------------------------------------
    | Production IPN verification URL
    |--------------------------------------------------------------------------
    |
    | This is the URL of real IPN verification
    |
    */
    'production_ipn_url' => 'https://ipnpb.paypal.com/cgi-bin/webscr',
    /*
    |--------------------------------------------------------------------------
    | Default Return Route
    |--------------------------------------------------------------------------
    |
    | This is the route name where the user will be redirected after a successful transaction.
    | If left empty, the user will be redirected to the path: '/' or to the URL specified while creating the transaction.
    |
    */
    'default_return_route' => '',
    /*
    |--------------------------------------------------------------------------
    | Default Negative Return Route
    |--------------------------------------------------------------------------
    |
    | This is the route name where the user will be redirected after a unsuccessful transaction.
    | If left empty, the user will be redirected to the default return route
    |
    */
    'default_negative_return_route' => '',
    /*
    |--------------------------------------------------------------------------
    | Default currency
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default currency used.
    |
    */
    'default_currency' => 'USD',
    /*
    |--------------------------------------------------------------------------
    | Route enabled
    |--------------------------------------------------------------------------
    |
    | Here you may enable or disable notification route. 
    | If the route is disabled, payment verification is not possible.
    |
    */
    'route_enabled' => true,
    /*
    |--------------------------------------------------------------------------
    | Table name
    |--------------------------------------------------------------------------
    |
    | Here you may specify table name with transactions
    |
    */
    'table_name' => 'paypal_transactions',
    /*
    |--------------------------------------------------------------------------
    | Personal Data
    |--------------------------------------------------------------------------
    |
    | Here you may specify Personal data columns that should be collected
    |
    */
    'personal_data_columns' => [
        'first_name',
        'last_name',
        'address_country',
        'address_city',
        'address_country_code',
        'address_name',
        'address_state',
        'address_status',
        'address_street',
        'address_zip',
        'contact_phone',
        'payer_business_name',
        'payer_email',
        'payer_id'
    ],
    /*
    |--------------------------------------------------------------------------
    | Additional payment data columns
    |--------------------------------------------------------------------------
    |
    | Here you may specify additional payment data columns that should be collected
    | Column name should match paypal field name
    |
    |
    */
    'additional_columns' => [],
    /*
    |--------------------------------------------------------------------------
    | Default status
    |--------------------------------------------------------------------------
    |
    | Default status that will be set for transaction at the beginning
    |
    */
    'default_status' => 'Started',
    /*
    |--------------------------------------------------------------------------
    | IPN response verification enabled
    |--------------------------------------------------------------------------
    |
    | Here you may disable or enable IPN response verification.
    | Option should be always enabled. For disabled option verification is not secure.
    | It should be disabled only for testing purpose or if you inspect problems from paypal side 
    |
    */
    'ipn_response_verification_enabled' => true
];
