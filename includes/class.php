<?php

/**
 * 
 */
class Content
{

	private $content;

	public function __construct()	{       
		
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles'),999);
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts'));
		add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_styles'), 999);
		add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_scripts'));

        $this->load_dependecies();
        
	}			

	public function load_dependecies(){	
        require_once plugin_dir_path( __FILE__ ) . 'CPT.php';
	}

    public function register_admin_styles() {
		wp_register_style( 'counter-widgets',  plugin_dir_url( __FILE__ ) . 'css/counters.css' );
		wp_enqueue_style( 'counter-widgets' );
        
	}
	public function register_admin_scripts() {
        
        wp_register_script( 'animation-image',  plugin_dir_url( __FILE__ ) . 'js/photo_upload.js' );
		wp_enqueue_script( 'animation-image' );

	}
	public function register_frontend_styles() {
		wp_register_style( 'counter-styles',  plugin_dir_url( __FILE__ ) . 'css/styles.css' );
		wp_enqueue_style( 'counter-styles' );
		wp_enqueue_style( 'animation-styles' );
        
	}
	public function register_frontend_scripts() {
        
		wp_register_script( 'animation-counter',  plugin_dir_url( __FILE__ ) . 'js/counter.js' );
		wp_enqueue_script( 'animation-counter' );

	}	


}



?>