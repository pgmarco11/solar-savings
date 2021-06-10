<?php

/**
 * 
 */
class Content
{
	protected $publish_date;

	private $content;

	public function __construct()	{       
		
        add_action( 'admin_enqueue_scripts', array( $this, 'register_counter_scripts') );
        
        $this->load_dependecies();
        
	}			

	public function load_dependecies(){	
        require_once plugin_dir_path( __FILE__ ) . 'CPT.php';
	}

    public function register_counter_scripts() {
		wp_register_style( 'counter-widgets',  plugin_dir_url( __FILE__ ) . '/css/counters.css' );
		wp_enqueue_style( 'counter-widgets' );
        
        wp_register_script( 'animation-image',  plugin_dir_url( __FILE__ ) . '/js/photo_upload.js' );
		wp_enqueue_script( 'animation-image' );
	}

}



?>