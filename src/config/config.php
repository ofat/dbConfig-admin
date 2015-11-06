<?php
/**
 * @author: Vitaliy Ofat <ofatv22@gmail.com>
 *
 * Simple config example
 */

use Ofat\DbConfigAdmin\Field;

return [
    'logs_table' => 'settings_logs',
    'pages' => [
        'acl' => [ // page name
            'name' => 'Access Control',
            'tabs' => [
                'admin' => [
                    'name' => 'Admin',
                    'items' => [
                        [
                            'field' => 'acl::custom.admins',
                            'type' => Field::TYPE_ARRAY_TEXT,
                            'label' => 'Admin Email',
                            'description' => ''
                        ],
                        [
                            'field' => 'acl::custom.admin_ip',
                            'type' => Field::TYPE_ARRAY_TEXT,
                            'label' => 'Admin IPs',
                            'description' => ''
                        ]
                    ]
                ],
                'media-buyer' => [
                    'name' => 'Media Buyer',
                    'items' => [
                        [
                            'field' => 'acl::custom.media_buyer_ip',
                            'type' => Field::TYPE_ARRAY_TEXT,
                            'label' => 'Media Buyer IPs'
                        ]
                    ]
                ],
                'publishers-feed' => [
                    'name' => 'Publishers Feed',
                    'items' => [
                        [
                            'field' => 'acl::custom.publishers_feed_parser_ips',
                            'type' => Field::TYPE_ARRAY_TEXT    ,
                            'label' => 'IPs list'
                        ]
                    ]
                ]
            ]
        ]
    ]
];