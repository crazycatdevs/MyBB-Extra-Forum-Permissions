<?php
/**
 * Extra Forum Permission Pack
 * Copyright 2011 Aries-Belgium
 *
 * $Id$
 */

namespace ExtraForumPermissions\Core;

const FIELDS_DATA = [
    'forumpermissions' => [
        'can_rate_own_threads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
            'form_options' => [
                'disabled_for_guest_group' => true
            ]
        ],
        'can_moderate_own_threads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 0,
            'form_type' => 'check_box',
        ],
        'canstickyownthreads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 0,
            'form_type' => 'check_box',
        ],
        'cancloseownthreads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 0,
            'form_type' => 'check_box',
        ],
        'can_post_links_in_threads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'can_post_links' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'canpostimages' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'canpostvideos' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'extra_subject_length' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 85,
            'form_type' => 'numeric',
            'form_options' => [
                'min' => 1,
                'max' => 255
            ]
        ],
        'extra_maximum_attachments' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 0,
            'form_type' => 'numeric',
            'form_options' => [
                'min' => 0,
                'max' => 255
            ]
        ],
    ],
    'usergroups' => [
        'can_rate_own_threads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'can_moderate_own_threads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 0,
            'form_type' => 'check_box',
        ],
        'canstickyownthreads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 0,
            'form_type' => 'check_box',
        ],
        'cancloseownthreads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 0,
            'form_type' => 'check_box',
        ],
        'can_post_links_in_threads' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'can_post_links' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'canpostimages' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'canpostvideos' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 1,
            'form_type' => 'check_box',
        ],
        'extra_subject_length' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 85,
            'form_type' => 'numeric',
            'form_options' => [
                'min' => 1,
                'max' => 255
            ]
        ],
        'extra_maximum_attachments' => [
            'type' => 'TINYINT',
            'unsigned' => true,
            'default' => 0,
            'form_type' => 'numeric',
            'form_options' => [
                'min' => 0,
                'max' => 255
            ]
        ],
    ]
];

const FIELDS_DATA_CORE = [
    'threads' => [
        'subject' => [
            'type' => 'VARCHAR',
            'size' => 255,
            'default' => '',
        ],
    ],
    'posts' => [
        'subject' => [
            'type' => 'VARCHAR',
            'size' => 255,
            'default' => '',
        ],
    ],
];

function load_language()
{
    global $lang;

    isset($lang->extraforumperm) || $lang->load('extraforumperm');
}

function addHooks(string $namespace)
{
    global $plugins;

    $namespaceLowercase = strtolower($namespace);
    $definedUserFunctions = get_defined_functions()['user'];

    foreach ($definedUserFunctions as $callable) {
        $namespaceWithPrefixLength = strlen($namespaceLowercase) + 1;

        if (substr($callable, 0, $namespaceWithPrefixLength) == $namespaceLowercase . '\\') {
            $hookName = substr_replace($callable, null, 0, $namespaceWithPrefixLength);

            $priority = substr($callable, -2);

            if (is_numeric(substr($hookName, -2))) {
                $hookName = substr($hookName, 0, -2);
            } else {
                $priority = 10;
            }

            $plugins->add_hook($hookName, $callable, $priority);
        }
    }
}