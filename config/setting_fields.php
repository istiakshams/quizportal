<?php

return [
    'sitename' => [
        'title' => 'Site Name',
        'desc' => 'Enter the site name',
        'icon' => 'far fa-lightbulb',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'site_name', // unique name for field
                'label' => 'Site Name', // you know what label it is
                'rules' => 'required|min:2|max:50', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'Site Name' // default value if you want
            ]
        ]
    ],
    'siteurl' => [
        'title' => 'Site Url',
        'desc' => 'Enter the site url',
        'icon' => 'far fa-lightbulb',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'site_url', // unique name for field
                'label' => 'Site Url', // you know what label it is
                'rules' => 'required|min:2|max:250', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'http://domain.com' // default value if you want
            ]
        ]
    ],
    'siteemail' => [
        'title' => 'Site Email',
        'desc' => 'Enter the site email',
        'icon' => 'far fa-lightbulb',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'site_email', // unique name for field
                'label' => 'Site Email', // you know what label it is
                'rules' => 'required|min:2|max:250', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'admin@domain.com' // default value if you want
            ]
        ]
    ],
    'sitetitle' => [
        'title' => 'Meta Title',
        'desc' => 'Meta title for the site',
        'icon' => 'far fa-lightbulb',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'meta_title', // unique name for field
                'label' => 'Meta Title', // you know what label it is
                'rules' => 'required|min:2|max:250', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'Meta Title' // default value if you want
            ]
        ]
    ],
    'sitedescription' => [
        'title' => 'Meta Description',
        'desc' => 'Meta description for the site',
        'icon' => 'far fa-lightbulb',

        'elements' => [
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'meta_description', // unique name for field
                'label' => 'Meta Description', // you know what label it is
                'rules' => 'required|min:2|max:250', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'Meta Description' // default value if you want
            ]
        ]
    ],
    'sitekeywords' => [
        'title' => 'Meta Keywords',
        'desc' => 'Meta keywords for the site',
        'icon' => 'far fa-lightbulb',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'meta_keywords', // unique name for field
                'label' => 'Meta keywords', // you know what label it is
                'rules' => 'required|min:2|max:250', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'Meta keywords' // default value if you want
            ]
        ]
    ],
    'aboutus' => [
        'title' => 'About Us Keywords',
        'desc' => 'About Us for the site',
        'icon' => 'far fa-lightbulb',

        'elements' => [
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'about_us', // unique name for field
                'label' => 'About Us', // you know what label it is
                'rules' => 'required|min:2|max:250', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'About Us' // default value if you want
            ]
        ]
    ],



];
