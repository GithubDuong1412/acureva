<?php

return [

    /*
     * Driver để kết nối. Với Mailchimp thì dùng MailchimpDriver.
     */
    'driver' => env('NEWSLETTER_DRIVER', Spatie\Newsletter\Drivers\MailchimpDriver::class),

    /*
     * Các tham số kết nối cho driver.
     */
    'driver_arguments' => [
        'api_key'  => env('NEWSLETTER_API_KEY'),
        'endpoint' => env('NEWSLETTER_ENDPOINT'),
    ],

    /*
     * Danh sách mặc định được sử dụng khi không truyền tên list.
     */
    'default_list_name' => 'subscribers',

    'lists' => [

        'subscribers' => [

            /*
             * Với Mailchimp, đây là List ID (Audience ID).
             */
            'id' => env('NEWSLETTER_LIST_ID'),
        ],
    ],
];
