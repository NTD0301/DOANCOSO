<?php

return [
    'bundling' => 'vite',
    'hot_file' => storage_path('framework/vite.hot'),
    'build_path' => 'build',
    'manifest_path' => public_path('build/manifest.json'),
    'entrypoints' => [
        'resources/js/app.js',
        'resources/css/app.css',
    ],
];
