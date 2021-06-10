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
require plugin_dir_path( __FILE__ ) . 'includes/class.php';


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
	$increment_number = get_post_meta($post->ID, 'increment_number', true);	
	$counters_description = get_post_meta($post->ID, 'counters_description', true);
	$widget_id = get_post_meta($post->ID, 'widget_id', true);
	$increment_id = get_post_meta($post->ID, 'increment_id', true);

?>
	<div id="counter_widgets">

		<ul>
			<li><label>Starting Generation Number:</label>
				<input name="starting_number" type="number" value="<?php echo isset($starting_number) ? $starting_number : ''; ?>" /><br>
				</li>
				<li><label>Increment:</label>
				<input name="increment_number" type="number" step="any" value="<?php echo isset($increment_number) ? $increment_number : ''; ?>" /><br>
				</li>
				<li><label>Increment Type: </label>
							
				<select name="increment_id" id="increment_id" onchange="changeIncrement()"> 			
					
							<?php				    
									$number = 1;

									$increments = ['seconds','minutes','hours','days'];					
						
									for ($number;$number<5;$number++) { 
					
										$incr = $increments[$number-1];
					
										?>
										<option value="<?php echo $incr ?>" <?php selected( $increment_id, $incr ); ?> ><?php echo $incr ?></option> 
										<?php
									} 
							?>
																														
				</select>

				</li>
				<li>
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
				</li>
				<li><label>Counters Description:</label>
				<br><br>
				<?php 
				wp_editor( htmlspecialchars_decode($counters_description), 'metabox_ID', $settings=array('textarea_name'=>'counters_description')); 
				?>
			</li>
		</ul>			
		
		<script type="text/javascript">

		let incID1 = document.getElementById("increment_id").value;
			
			
		</script>	

		


		<div id="widget_settings">

			<div id="widget_list">

			</div>

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
									<?php
									 $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); 
									 $amt_widget1 = get_post_meta($post->ID, 'amt_widget1', true);
									 $animation1 = get_post_meta($post->ID, 'animation1', true);
									 $image_url1 = get_post_meta($post->ID, 'image_url1', true); 					
									 $image_id1 = get_post_meta($post->ID, 'image_id1', true); 
						
									?>
								} else if(widgetID == 2){
									<?php 
									 $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); 
									 $name_widget2 = get_post_meta($post->ID, 'name_widget2', true);
									 
									 $amt_widget1 = get_post_meta($post->ID, 'amt_widget1', true);
									 $amt_widget2 = get_post_meta($post->ID, 'amt_widget2', true);

									 $animation1 = get_post_meta($post->ID, 'animation1', true); 
									 $animation2 = get_post_meta($post->ID, 'animation2', true); 

									 $image_url1 = get_post_meta($post->ID, 'image_url1', true); 
									 $image_url2 = get_post_meta($post->ID, 'image_url2', true); 
								

									 $image_id1 = get_post_meta($post->ID, 'image_id1', true); 
									 $image_id2 = get_post_meta($post->ID, 'image_id2', true); 
							
									 ?>
								} else if(widgetID == 3){
									<?php 
									$name_widget1 = get_post_meta($post->ID, 'name_widget1', true);
									$name_widget2 = get_post_meta($post->ID, 'name_widget2', true);
									$name_widget3 = get_post_meta($post->ID, 'name_widget3', true);
									$amt_widget1 = get_post_meta($post->ID, 'amt_widget1', true);
									$amt_widget2 = get_post_meta($post->ID, 'amt_widget2', true);
									$amt_widget3 = get_post_meta($post->ID, 'amt_widget3', true);
									
									$animation1 = get_post_meta($post->ID, 'animation1', true); 
									$animation2 = get_post_meta($post->ID, 'animation2', true); 
									$animation3 = get_post_meta($post->ID, 'animation3', true); 

									$image_url1 = get_post_meta($post->ID, 'image_url1', true); 
									$image_url2 = get_post_meta($post->ID, 'image_url2', true); 
									$image_url3 = get_post_meta($post->ID, 'image_url3', true); 							

									$image_id1 = get_post_meta($post->ID, 'image_id1', true); 
									$image_id2 = get_post_meta($post->ID, 'image_id2', true); 
									$image_id3 = get_post_meta($post->ID, 'image_id3', true); 
								
									 ?>
								} else {
									<?php 
									$name_widget1 = get_post_meta($post->ID, 'name_widget1', true); 
									 $name_widget2 = get_post_meta($post->ID, 'name_widget2', true); 
									 $name_widget3 = get_post_meta($post->ID, 'name_widget3', true); 
									 $name_widget4 = get_post_meta($post->ID, 'name_widget4', true); 
									 $amt_widget1 = get_post_meta($post->ID, 'amt_widget1', true);
									 $amt_widget2 = get_post_meta($post->ID, 'amt_widget2', true);
									 $amt_widget3 = get_post_meta($post->ID, 'amt_widget3', true);
									 $amt_widget4 = get_post_meta($post->ID, 'amt_widget4', true);
									 $animation1 = get_post_meta($post->ID, 'animation1', true); 
									 $animation2 = get_post_meta($post->ID, 'animation2', true); 
									 $animation3 = get_post_meta($post->ID, 'animation3', true); 
									 $animation4 = get_post_meta($post->ID, 'animation4', true); 

									 $image_url1 = get_post_meta($post->ID, 'image_url1', true); 
									 $image_url2 = get_post_meta($post->ID, 'image_url2', true); 
									 $image_url3 = get_post_meta($post->ID, 'image_url3', true); 
									 $image_url4 = get_post_meta($post->ID, 'image_url4', true); 

									 $image_id1 = get_post_meta($post->ID, 'image_id1', true); 
									 $image_id2 = get_post_meta($post->ID, 'image_id2', true); 
									 $image_id3 = get_post_meta($post->ID, 'image_id3', true); 
									 $image_id4 = get_post_meta($post->ID, 'image_id4', true); 


									?>
								}
							

							for (number;number<widgetID+1;number++) { 		
									
							if(number == 1){
							newWidgets = '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget1) ? $name_widget1 : ''; ?>" type="text" /><br></li><li><label>Amount:</label><input name="amt_widget'+number+'" value="<?php echo isset($amt_widget1) ? $amt_widget1 : ''; ?>" type="number" step="any" /></li><li><label>Animation / Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo isset($animation1) ? $animation1 : ''; ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo isset($image_url1) ? $image_url1 : ''; ?>" /><input type="text" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo isset($image_id1) ? $image_id1 : ''; ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else if(number == 2){
							newWidgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget2) ? $name_widget2 : ''; ?>" type="text" /><br></li><li><label>Amount:</label><input name="amt_widget'+number+'" value="<?php echo isset($amt_widget2) ? $amt_widget2 : ''; ?>" type="number" step="any" /></li><li><label>Animation / Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo isset($animation2) ? $animation2 : ''; ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo isset($image_url2) ? $image_url2 : ''; ?>" /><input type="text" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo isset($image_id2) ? $image_id2 : ''; ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else if(number == 3){
							newWidgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget3) ? $name_widget3 : ''; ?>" type="text" /><br></li><li><label>Amount:</label><input name="amt_widget'+number+'" value="<?php echo isset($amt_widget3) ? $amt_widget3 : ''; ?>" type="number" step="any" /></li><li><label>Animation / Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo isset($animation3) ? $animation3 : ''; ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo isset($image_url3) ? $image_url3 : ''; ?>" /><input type="text" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo isset($image_id3) ? $image_id3 : ''; ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else {
							newWidgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget4) ? $name_widget4 : ''; ?>" type="text" /><br></li><li><label>Amount:</label><input name="amt_widget'+number+'" value="<?php echo isset($amt_widget4) ? $amt_widget4 : ''; ?>" type="number" step="any" /></li><li><label>Animation / Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo isset($animation4) ? $animation4 : ''; ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo isset($image_url4) ? $image_url4 : ''; ?>" /><input type="text" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo isset($image_id4) ? $image_id4 : ''; ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
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
									<?php
									 $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); 
									 $amt_widget1 = get_post_meta($post->ID, 'amt_widget1', true);
									 $animation1 = get_post_meta($post->ID, 'animation1', true);
									 $image_url1 = get_post_meta($post->ID, 'image_url1', true); 					
									 $image_id1 = get_post_meta($post->ID, 'image_id1', true); 
						
									?>
								} else if(widgetID == 2){
									<?php 
									 $name_widget1 = get_post_meta($post->ID, 'name_widget1', true); 
									 $name_widget2 = get_post_meta($post->ID, 'name_widget2', true);
									 
									 $amt_widget1 = get_post_meta($post->ID, 'amt_widget1', true);
									 $amt_widget2 = get_post_meta($post->ID, 'amt_widget2', true);

									 $animation1 = get_post_meta($post->ID, 'animation1', true); 
									 $animation2 = get_post_meta($post->ID, 'animation2', true); 

									 $image_url1 = get_post_meta($post->ID, 'image_url1', true); 
									 $image_url2 = get_post_meta($post->ID, 'image_url2', true); 
								

									 $image_id1 = get_post_meta($post->ID, 'image_id1', true); 
									 $image_id2 = get_post_meta($post->ID, 'image_id2', true); 
							
									 ?>
								} else if(widgetID == 3){
									<?php 
									$name_widget1 = get_post_meta($post->ID, 'name_widget1', true);
									$name_widget2 = get_post_meta($post->ID, 'name_widget2', true);
									$name_widget3 = get_post_meta($post->ID, 'name_widget3', true);
									$amt_widget1 = get_post_meta($post->ID, 'amt_widget1', true);
									$amt_widget2 = get_post_meta($post->ID, 'amt_widget2', true);
									$amt_widget3 = get_post_meta($post->ID, 'amt_widget3', true);
									
									$animation1 = get_post_meta($post->ID, 'animation1', true); 
									$animation2 = get_post_meta($post->ID, 'animation2', true); 
									$animation3 = get_post_meta($post->ID, 'animation3', true); 

									$image_url1 = get_post_meta($post->ID, 'image_url1', true); 
									$image_url2 = get_post_meta($post->ID, 'image_url2', true); 
									$image_url3 = get_post_meta($post->ID, 'image_url3', true); 							

									$image_id1 = get_post_meta($post->ID, 'image_id1', true); 
									$image_id2 = get_post_meta($post->ID, 'image_id2', true); 
									$image_id3 = get_post_meta($post->ID, 'image_id3', true); 
								
									 ?>
								} else {
									<?php 
									$name_widget1 = get_post_meta($post->ID, 'name_widget1', true); 
									 $name_widget2 = get_post_meta($post->ID, 'name_widget2', true); 
									 $name_widget3 = get_post_meta($post->ID, 'name_widget3', true); 
									 $name_widget4 = get_post_meta($post->ID, 'name_widget4', true); 
									 $amt_widget1 = get_post_meta($post->ID, 'amt_widget1', true);
									 $amt_widget2 = get_post_meta($post->ID, 'amt_widget2', true);
									 $amt_widget3 = get_post_meta($post->ID, 'amt_widget3', true);
									 $amt_widget4 = get_post_meta($post->ID, 'amt_widget4', true);
									 $animation1 = get_post_meta($post->ID, 'animation1', true); 
									 $animation2 = get_post_meta($post->ID, 'animation2', true); 
									 $animation3 = get_post_meta($post->ID, 'animation3', true); 
									 $animation4 = get_post_meta($post->ID, 'animation4', true); 

									 $image_url1 = get_post_meta($post->ID, 'image_url1', true); 
									 $image_url2 = get_post_meta($post->ID, 'image_url2', true); 
									 $image_url3 = get_post_meta($post->ID, 'image_url3', true); 
									 $image_url4 = get_post_meta($post->ID, 'image_url4', true); 

									 $image_id1 = get_post_meta($post->ID, 'image_id1', true); 
									 $image_id2 = get_post_meta($post->ID, 'image_id2', true); 
									 $image_id3 = get_post_meta($post->ID, 'image_id3', true); 
									 $image_id4 = get_post_meta($post->ID, 'image_id4', true); 


									?>
								}
												
						for (number;number<widgetID+1;number++) { 
										
							if(number == 1){
								widgets = '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget1) ? $name_widget1 : ''; ?>" type="text" /><br></li><li><label>Amount:</label><input name="amt_widget'+number+'" value="<?php echo isset($amt_widget1) ? $amt_widget1 : ''; ?>" type="number" step="any" /></li><li><label>Animation / Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo isset($animation1) ? $animation1 : ''; ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo isset($image_url1) ? $image_url1 : ''; ?>" /><input type="text" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo isset($image_id1) ? $image_id1 : ''; ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else if(number == 2){
								widgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget2) ? $name_widget2 : ''; ?>" type="text" /><br></li><li><label>Amount:</label><input name="amt_widget'+number+'" value="<?php echo isset($amt_widget2) ? $amt_widget2 : ''; ?>" type="number" step="any" /></li><li><label>Animation / Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo isset($animation2) ? $animation2 : ''; ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo isset($image_url2) ? $image_url2 : ''; ?>" /><input type="text" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo isset($image_id2) ? $image_id2 : ''; ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else if(number == 3){
								widgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget3) ? $name_widget3 : ''; ?>" type="text" /><br></li><li><label>Amount:</label><input name="amt_widget'+number+'" value="<?php echo isset($amt_widget3) ? $amt_widget3 : ''; ?>" type="number" step="any" /></li><li><label>Animation / Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo isset($animation3) ? $animation3 : ''; ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo isset($image_url3) ? $image_url3 : ''; ?>" /><input type="text" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo isset($image_id3) ? $image_id3 : ''; ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else {
								widgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo isset($name_widget4) ? $name_widget4 : ''; ?>" type="text" /><br></li><li><label>Amount:</label><input name="amt_widget'+number+'" value="<?php echo isset($amt_widget4) ? $amt_widget4 : ''; ?>" type="number" step="any" /></li><li><label>Animation / Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo isset($animation4) ? $animation4 : ''; ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo isset($image_url4) ? $image_url4 : ''; ?>" /><input type="text" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo isset($image_id4) ? $image_id4 : ''; ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
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
		if( isset($_POST['increment_number']) ){
			update_post_meta($post_id, "increment_number", $_POST["increment_number"]);
		}
		if( isset($_POST['increment_id']) ){
			update_post_meta($post_id, "increment_id", $_POST["increment_id"]);
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
			if( isset($_POST['amt_widget1']) ){
				update_post_meta($post_id, "amt_widget1", $_POST["amt_widget1"]);
			}
			if( isset($_POST['amt_widget2']) ){
				update_post_meta($post_id, "amt_widget2", $_POST["amt_widget2"]);
			}
			if( isset($_POST['amt_widget3']) ){
				update_post_meta($post_id, "amt_widget3", $_POST["amt_widget3"]);
			}
			if( isset($_POST['amt_widget4']) ){
				update_post_meta($post_id, "amt_widget4", $_POST["amt_widget4"]);
			}
			if( isset($_POST['animation1']) ){
				update_post_meta($post_id, "animation1", $_POST["animation1"]);
			}
			if( isset($_POST['animation2']) ){
				update_post_meta($post_id, "animation2", $_POST["animation2"]);
			}
			if( isset($_POST['animation3']) ){
				update_post_meta($post_id, "animation3", $_POST["animation3"]);
			}
			if( isset($_POST['animation4']) ){
				update_post_meta($post_id, "animation4", $_POST["animation4"]);
			}

			if( isset($_POST['image_url1']) ){
				update_post_meta($post_id, "image_url1", $_POST["image_url1"]);
			}
			if( isset($_POST['image_url2']) ){
				update_post_meta($post_id, "image_url2", $_POST["image_url2"]);
			}
			if( isset($_POST['image_url3']) ){
				update_post_meta($post_id, "image_url3", $_POST["image_url3"]);
			}
			if( isset($_POST['image_url4']) ){
				update_post_meta($post_id, "image_url4", $_POST["image_url4"]);
			}

			if( isset($_POST['image_id1']) ){
				update_post_meta($post_id, "image_id1", $_POST["image_id1"]);
			}
			if( isset($_POST['image_id2']) ){
				update_post_meta($post_id, "image_id2", $_POST["image_id2"]);
			}
			if( isset($_POST['image_id3']) ){
				update_post_meta($post_id, "image_id3", $_POST["image_id3"]);
			}
			if( isset($_POST['image_id4']) ){
				update_post_meta($post_id, "image_id4", $_POST["image_id4"]);
			}

		}

	}

}
add_action('save_post', 'pg_counter_save');

?>