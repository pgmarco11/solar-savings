<?php

class Counter extends Content {

	public function __construct(){

		parent::__construct();

		$pg_counter_widget = array(
			'label' 			=> __('Counters'),
			'singular_label' 	=> __('Counter'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'capability_type' 	=> 'post',
			'hierarchical' 		=> false,
			'has_archive' 		=> false,
			'supports' 			=> array('title','editor','excerpt','page-attributes','custom-fields'),
			'rewrite' 			=> array('slug' => 'counter', 'with_front' => false)
		);

		register_post_type('counter', $pg_counter_widget);

		add_image_size('counter-image', 200, 200, array( 'center', 'center' ));


	}

	public function post( $content ){
		$this->format_content( $content );
		var_dump($content);
	}
	

}

?>