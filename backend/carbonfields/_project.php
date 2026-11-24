<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Projekt')
    ->where('post_type', '=', 'project')
    ->add_fields([
        Field::make('text', 'video', 'Vimeo-Link')
            ->set_attribute('type', 'url')
            ->set_attribute('placeholder', 'https://vimeo.com/123456789')
            ->set_required(),
        Field::make('image', 'thumbnail', 'Vorschaubild')
            ->set_required()
            ->set_help_text('Wird als Vorschau und Poster des Videos verwendet'),
        Field::make('text', 'client', 'Client'),
        Field::make('date', 'release_date', 'Veröffentlichung')
            ->set_storage_format('Y-m-d'),
        Field::make('textarea', 'description', 'Beschreibung')
            ->set_help_text('Optional, z. B. für einen Teaser'),
        Field::make('complex', 'credits', 'Credits')
            ->set_layout('tabbed-vertical')
            ->add_fields([
                Field::make('text', 'role', 'Rolle'),
                Field::make('text', 'name', 'Name'),
            ])
            ->set_header_template('<%- role %>: <%- name %>'),
    ]);