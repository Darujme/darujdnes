<?php

if (!defined('DARUJME_PROJECT_POST_TYPE')) {
	define('DARUJME_PROJECT_POST_TYPE', 'page');
}

add_filter( 'rwmb_meta_boxes', 'register_meta_boxes' );

function register_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'id'         => 'contributebox',
		'title'      => 'CTA Lišta',
		'post_types' => array( DARUJME_PROJECT_POST_TYPE ),

		'fields' => array(
			array(
				'name'  => 'Logo',
				'id'    => 'cta_logo',
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'desc' => 'Bude oříznuto a zmenšeno na 100x100px'
			),
			array(
				'name' => 'Button',
				'type'  => 'heading',
			),
			array(
				'id'    => 'cta_button',
				'name'  => 'Zobrazit?',
				'type'  => 'checkbox'
			),
			array(
				'id'    => 'cta_button_label',
				'name'  => 'Popisek',
				'type'  => 'text'
			),
			array(
				'id'    => 'cta_button_link',
				'name'  => 'Odkaz',
				'type'  => 'url'
			),
			array(
				'name' => 'Nastavení',
				'type'  => 'heading',
			),
			array(
				'id'    => 'cta_price',
				'name'  => 'Zobrazit vybranou částku?',
				'type'  => 'checkbox'
			),
			array(
				'id'    => 'cta_subscribers',
				'name'  => 'Zobrazit počet přispěvovatelů?',
				'type'  => 'checkbox',
				'desc'	=> '(Vyžaduje aktivní button.)'
			),
			array(
				'id'    => 'cta_progressbar',
				'name'  => 'Zobrazit progressbar?',
				'type'  => 'checkbox',
				'desc'	=> '(Vyžaduje aktivní vybranou částku.)'
			),
			array(
				'id'    => 'cta_target',
				'name'  => 'Zobrazit cílovou částku?',
				'type'  => 'checkbox',
				'desc'	=> '(Vyžaduje aktivní vybranou částku.)'
			),
			array(
				'id'    => 'cta_target_price',
				'name'  => 'Cílová částka',
				'type'  => 'text'
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'header',
		'title'      => 'Hlavička',
		'post_types' => array( DARUJME_PROJECT_POST_TYPE ),

		'fields' => array(
			array(
				'name'  => 'Fotka na pozadí',
				'id'    => 'h_image',
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),
			array(
				'name'  => 'Titulek',
				'id'    => 'h_title',
				'type'  => 'textarea',
			),
			array(
				'id'    => 'h_editor',
				'type'  => 'wysiwyg',
				'options' => array(
					'wpautop' => false
				)
			),
			array(
				'id'    => 'h_morebtn',
				'name'  => 'Zobrazit tlačítko více info?',
				'type'  => 'checkbox',
				'desc'  => 'Toto tlačítko funguje jako kotva na další obsah.'
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'sidebar',
		'title'      => 'Sidebar',
		'post_types' => array( DARUJME_PROJECT_POST_TYPE ),
		'fields'     => array(
			array(
				'name' => 'Galerie',
				'id'   => 'sidebar_gallery',
				'type'  => 'image_advanced',
				'max_file_uploads' => 4,
				'desc' => 'Pokud nejsou nahrány 4 fotky tak se galerie vůbec nezobrazí.'
			),
			array(
				'name' => 'Rychlý kontakt',
				'type'  => 'heading',
			),
			array(
				'id'    => 's_tile',
				'name'  => 'Aktivní?',
				'type'  => 'checkbox'
			),
			array(
				'name' => 'Nadpis',
				'type'  => 'text',
				'id'	=> 's_title',
				'desc' => 'Např. Nevíte si rady?'
			),
			array(
				'name'  => 'Profilová fotka',
				'id'    => 's_image',
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
				'desc' => 'Bude oříznuta a zmenšena na 100x100px'
			),
			array(
				'name' => 'Jméno',
				'type'  => 'text',
				'id'	=> 's_name'
			),
			array(
				'name' => 'Email',
				'type'  => 'text',
				'id'	=> 's_email'
			),
			array(
				'name' => 'Telefon',
				'type'  => 'text',
				'id'	=> 's_phone'
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'projects',
		'title'      => 'Projekty',
		'post_types' => array( DARUJME_PROJECT_POST_TYPE ),
		'fields'     => array(
			array(
				'name' => 'Nadpis',
				'type'  => 'text',
				'id'	=> 'p_title',
			),
			array(
				'name'  => 'Text',
				'id'    => 'p_editor',
				'type'  => 'textarea',
				'rows' => 6
			),

		)
	);

	return $meta_boxes;
}
