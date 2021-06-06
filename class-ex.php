<?php

/*
 * Counter Widgets
 *
 *
 * Plugin Name:		Counter Widgets
 * Description:		This plugin creates counter widgets to be displayed on your site.
 * Version:			0.0.1
 * Author:			Peter Giammarco
 * Author URI:		http://www.pgiammarco.com
 * Text Domain:		pg_counter_widget
 * License:			GPLv3
 * License URI:		http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: 	/languages
*/


//If this file is called directly, the abort execution.
if ( ! defined('WPINC') ){
	die;
}

/**
* Include the core class responsible for loading all necessary components of the counter plugin.
*
*/
require_once plugin_dir_path( __FILE__ ) . 'includes/class.php';

/**
* Instantiates the Single Post Meta Manager class and then calls
* its run method officially starting up the plugin.
*/
function run_counters(){

	$content = new Content();

	$counters = new CPT(array(
		'post_type_name' => 'counter',
		'singular' => 'Counter',
		'plural' => 'Counters',
		'slug' => 'counters',
		'supports' => array('title', 'thumbnail', 'excerpt', 'page-attributes','custom-fields')
	));

}

//call the above function to begin execution of the plugin
run_counters();

function pg_counter_meta(){

	add_meta_box('counter_settings', 'Counter Widget Settings', 'pg_counter_settings','counter', 'advanced', 'core');
	
	remove_post_type_support( 'counter', 'editor' );
	
}
add_action('admin_init', 'pg_counter_meta');

function pg_counter_settings(){

	global $post;

	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	$starting_number = get_post_meta($post->ID, 'starting_number', true);	
	$counters_description = get_post_meta($post->ID, 'counters_description', true);
	$widget_id = get_post_meta($post->ID, 'widget_id', true);

	var_dump($widget_id);

?>
	<div id="counter_widgets">

		<ul>
			<li><label>Starting Generation Number:</label>
				<input name="starting_number" type="number" value="<?php echo isset($starting_number) ? $starting_number : ''; ?>" /><br>
				</li>
				<li><label>Increment:</label>
				<input name="increment_number" type="number" value="<?php echo isset($increment_number) ? $increment_number : ''; ?>" /><br>
				</li>
				<li><label>Counters Description:</label>
				<br><br>
				<?php 
				wp_editor( htmlspecialchars_decode($counters_description), 'metabox_ID', $settings=array('textarea_name'=>'counters_description')); 
				?>
			</li>
		</ul>			
		
		<label># of Widgets: </label>
			
		<select name="widget_id" id="widget_id" onchange="changeWidgets()"> 

	        <option selected="selected" value=""><?php echo esc_attr( __( 'None' ) ); ?>
	        </option> 
	        <?php				    
					$number = 1;

	                for ($number;$number<5;$number++) { 						

	                	?>
	                     <option value="<?php echo $number ?>" <?php selected( $widget_id, $number ); ?> ><?php echo $number ?></option> 
	                    <?php
	                } 
			?>
                                                                                                                
	    </select>

		<div id="widget_settings">
			<ul id="widget_list">

			</ul>
		</div>	
				

			<script type="text/javascript">

					function changeWidgets(){

						let showWidgets = document.getElementById("widget_list");
						let widgetID = document.getElementById("widget_id").value;
						widgetID = parseInt(widgetID);
						let number = 1;

						if(widgetID != ''){ 

							newWidgets = '';
							
							if(widgetID == 1){
									<?php $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); ?>
								} else if(widgetID == 2){
									<?php $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); ?>
									<?php $name_widget2 = get_post_meta($post->ID, 'name_widget2', true); ?>
								} else if(widgetID == 3){
									<?php $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); ?>
									<?php $name_widget2 = get_post_meta($post->ID, 'name_widget2', true); ?>
									<?php $name_widget3 = get_post_meta($post->ID, 'name_widget3', true); ?>
								} else {
									<?php $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); ?>
									<?php $name_widget2 = get_post_meta($post->ID, 'name_widget2', true); ?>
									<?php $name_widget3 = get_post_meta($post->ID, 'name_widget3', true); ?>
									<?php $name_widget4 = get_post_meta($post->ID, 'name_widget4', true); ?>
							}
							

							for (number;number<widgetID+1;number++) { 		
									
								if(number == 1){
									newWidgets = '<li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget1) ? $name_widget1 : ''; ?>" type="text" /><br></li><li><label>Amount:</label></li>';
								} else if(number == 2){
									newWidgets += '<li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget2) ? $name_widget2 : ''; ?>" type="text" /><br></li><li><label>Amount:</label></li>';
								} else if(number == 3){
									newWidgets += '<li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget3) ? $name_widget3 : ''; ?>" type="text" /><br></li><li><label>Amount:</label></li>';
								} else {
									newWidgets += '<li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget4) ? $name_widget4 : ''; ?>" type="text" /><br></li><li><label>Amount:</label></li>';
								}

							}


						}

						showWidgets.innerHTML = newWidgets;

					}

					let showWidgets = document.getElementById("widget_list");
					let widgetID = document.getElementById("widget_id").value;
					widgetID = parseInt(widgetID);
					let number = 1;

					console.log('widgetID: '+widgetID);
					console.log('number: '+number);

					if( isNaN(widgetID) === false){ 

						widgets = '';

						if(widgetID == 1){
								<?php $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); ?>
							} else if(widgetID == 2){
								<?php $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); ?>
								<?php $name_widget2 = get_post_meta($post->ID, 'name_widget2', true); ?>
							} else if(widgetID == 3){
								<?php $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); ?>
								<?php $name_widget2 = get_post_meta($post->ID, 'name_widget2', true); ?>
								<?php $name_widget3 = get_post_meta($post->ID, 'name_widget3', true); ?>
							} else {
								<?php $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); ?>
								<?php $name_widget2 = get_post_meta($post->ID, 'name_widget2', true); ?>
								<?php $name_widget3 = get_post_meta($post->ID, 'name_widget3', true); ?>
								<?php $name_widget4 = get_post_meta($post->ID, 'name_widget4', true); ?>
						}
												
						for (number;number<widgetID+1;number++) { 
										
							if(number == 1){
								widgets = '<li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget1) ? $name_widget1 : ''; ?>" type="text" /><br></li><li><label>Amount:</label></li>';
							} else if(number == 2){
								widgets += '<li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget2) ? $name_widget2 : ''; ?>" type="text" /><br></li><li><label>Amount:</label></li>';
							} else if(number == 3){
								widgets += '<li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget3) ? $name_widget3 : ''; ?>" type="text" /><br></li><li><label>Amount:</label></li>';
							} else {
								widgets += '<li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget4) ? $name_widget4 : ''; ?>" type="text" /><br></li><li><label>Amount:</label></li>';
							}

						}

					} else {

						widgets = '<li>Select the number of widgets from the dropdown</li>';

					}	
					
					showWidgets.innerHTML = widgets;
					
					

			</script>	

	</div>

<?php
}

function pg_counter_save($post_id){

	global $post;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

		return;

	} else {

		if( isset($_POST['starting_number']) ){
			update_post_meta($post_id, "starting_number", $_POST["starting_number"]);
		}		
		if( isset($_POST['counters_description']) ){
			$data=htmlspecialchars($_POST['counters_description']);
			update_post_meta($post_id, 'counters_description',$data);
		}

		if( isset($_POST['widget_id']) ){
			
			update_post_meta($post_id, "widget_id", $_POST["widget_id"]);
			
			if( isset($_POST['name_widget1']) ){
				update_post_meta($post_id, "name_widget1", $_POST["name_widget1"]);
			}
			if( isset($_POST['name_widget2']) ){
				update_post_meta($post_id, "name_widget2", $_POST["name_widget2"]);
			}
			if( isset($_POST['name_widget3']) ){
				update_post_meta($post_id, "name_widget3", $_POST["name_widget3"]);
			}
			if( isset($_POST['name_widget4']) ){
				update_post_meta($post_id, "name_widget4", $_POST["name_widget4"]);
			}
	


		}

	}

}
add_action('save_post', 'pg_counter_save');

?>