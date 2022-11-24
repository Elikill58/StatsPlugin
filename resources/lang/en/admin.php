<?php

return [
    'title' => 'PlayerStats',
    'permission' => 'Manage plugin for player statistics',
    'stats' => [
        'index' => 'Stats',
        'none' => 'You don\'t have statistics yet',
        'title' => 'Create stats',
        'title-edit' => 'Edit :name',
        'title-list' => 'List all stats',
        'default-skin' => 'Minecraft skin by default',
        'created' => 'Stats created.',
        'updated' => 'Stats updated.',
        'deleted' => 'Stats deleted.',
        'column' => 'Column',
        'linked' => 'Linked to',
        'timed_from' => 'Time from',
        'prefix' => 'Prefix',
        'suffix' => 'Suffix',
        'rounded_amount' => 'Decimal after point',
        'split' => 'Splitter',
        'style' => [
            'index' => 'Style',
            'basic' => 'Basic',
            'ratio' => 'Ratio',
            'timed' => 'Time',
            'rounded' => 'Rounded number',
            'presuffix' => 'Prefix & Suffix',
            'count' => 'Occurences'
        ]
    ],
    'game' => [
        'index' => 'Game',
        'show' => 'See a game',
        'title' => 'Create a game jeu',
        'title-edit' => 'Edit the game',
        'title-list' => 'List all games',
        'created' => 'Game created.',
        'updated' => 'Game updated.',
        'deleted' => 'Game deleted.',
        'table' => 'Table',
        'unique_col' => 'Column for unique identifier of player (UUID)',
        'show_profile' => 'See on profil',
        'empty_to_keep' => 'Keep empty to see global value (Global value put on Azuriom)',
        'import' => [
            'title' => 'Import all stats',
            'details' => 'WARN: It will remove all stats',
            'confirm' => 'Are you sure you would like to CLEAR all stats before importing them ?'
        ]
    ],
    'setting' => [
        'title' => 'Parameter',
        'created' => 'Parameter created.',
        'updated' => 'Parameter updated.',
        'deleted' => 'Parameter deleted.',
        'settings' => [
            'uuid_name' => 'Configuration of correspondance UUID <=> Pseudo:',
            'table' => 'Table',
            'column_uuid' => 'Column for UUID',
            'column_name' => 'Column for pseudo',
            'stats_route' => 'Utilise route \'/stats\' and not only \'/playerstats\' (*can create conflict)',
            'site_head' => 'Site used to show players head'
        ]
    ],
    'timed' => [
        'millisecond' => 'Millisecond',
        'second' => 'Second',
        'minute' => 'Minut',
        'hour' => 'Hour',
        'day' => 'Day',
        'month' => 'Month',
        'year' => 'Year'
    ]
];
