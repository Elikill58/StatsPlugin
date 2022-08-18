<?php

return [
    'title' => 'PlayerStats',
    'stats' => [
        'index' => 'Stats',
        'none' => 'Vous n\'avez pas encore de statistiques',
        'title' => 'Créer une stats',
        'title-edit' => 'Modifier :name',
        'title-list' => 'Liste des stats',
        'default-skin' => 'Par défaut skin minecraft',
        'created' => 'Stats créé.',
        'updated' => 'Stats mis à jour.',
        'deleted' => 'Stats supprimé.',
        'column' => 'Colonne',
        'linked' => 'Lié à',
        'timed_from' => 'Temps de base en',
        'prefix' => 'Préfixe',
        'suffix' => 'Suffixe',
        'rounded_amount' => 'Chiffre après la virgule',
        'style' => [
            'index' => 'Style',
            'basic' => 'Basique',
            'ratio' => 'Ratio',
            'timed' => 'Temps',
            'rounded' => 'Nombre arrondi',
            'presuffix' => 'Préfix & Suffix'
        ]
    ],
    'game' => [
        'index' => 'Jeux',
        'show' => 'Voir un jeu',
        'title' => 'Créer un jeu',
        'title-edit' => 'Modifier le jeu',
        'title-list' => 'Liste des jeux',
        'created' => 'Jeu créé.',
        'updated' => 'Jeu mis à jour.',
        'deleted' => 'Jeu supprimé.',
        'table' => 'Table',
        'unique_col' => 'Colonne pour l\'identifiant unique du joueur (UUID)',
        'show_profile' => 'Voir sur le profil',
        'empty_to_keep' => 'Laisser vide pour garder la valeur global (c\'est-à-dire les valeurs utilisées par Azuriom)',
        'import' => [
            'title' => 'Importer toutes les statistiques',
            'details' => 'ATTENTION: supprime toutes les statistiques',
            'confirm' => 'Êtes-vous sûr de vouloir supprimer toutes les statistiques avant de les importer ?'
        ]
    ],
    'setting' => [
        'title' => 'Paramètre',
        'created' => 'Paramètre créé.',
        'updated' => 'Paramètre mis à jour.',
        'deleted' => 'Paramètre supprimé.',
        'settings' => [
            'uuid_name' => 'Configuration de la correspondance UUID <=> Pseudo:',
            'table' => 'Table',
            'column_uuid' => 'Colonne pour les UUID',
            'column_name' => 'Colonne pour les pseudo',
            'stats_route' => 'Utiliser la route \'/stats\' en plus de \'/playerstats\' (*peut créer des conflits)',
            'site_head' => 'Site utilisé pour afficher les têtes des joueurs'
        ]
    ],
    'timed' => [
        'millisecond' => 'Milliseconde',
        'second' => 'Seconde',
        'minute' => 'Minute',
        'hour' => 'Heure',
        'day' => 'Jour',
        'month' => 'Mois',
        'year' => 'Année'
    ]
];
