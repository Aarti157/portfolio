<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Inhaltsfeld-Konfiguration der globalen Einstellungen des Themes
Container::make('theme_options', 'Globales')
    ->add_fields([
        Field::make( 'image', 'logo',  'Logo' ),
        // ich habe kein logo,
        // aber falls ich mal eins möchte muss ich nur noch
        // über backend,getter, globals.php das logo abrufen
        // und dann im header funktion ausführen

        Field::make( 'complex', 'socials', 'Socials')
    ->add_fields([
        Field::make( 'text', 'title', 'Titel' ),
        Field::make( 'text', 'link', 'Link'),
        Field::make( 'image', 'icon', 'Icon'),
        ] )
        ->set_header_template('<% if (title) { %><%- title %><% } %>')
    ]);
 