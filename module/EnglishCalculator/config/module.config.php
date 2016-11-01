<?php

return [
    'controllers' => [
        'factories' => [
            'EnglishCalculator.Controller.Index' => 'EnglishCalculator\Factory\IndexControllerFactory'
        ]
    ],
    'router' => [
        'routes' => [
            'index' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'EnglishCalculator.Controller.Index',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'errors/404',
        'exception_template' => 'errors/500',
        'template_map' => [
            'errors/404'               => __DIR__ . '/../view/errors/404.phtml',
            'errors/500'               => __DIR__ . '/../view/errors/500.phtml',
        ],
        'template_path_stack' => [
            __DIR__.'/../view'
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'EnglishCalculator.Service.Calculator' => 'EnglishCalculator\Service\CalculatorService'
        ]
    ]
];