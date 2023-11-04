<?php

/*
 * Plugin Name:		Solar Savings Calculator
 * Description:		This plugin creates counter widgets to calculate Solar Savings and displays it on the page or post.
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

//shortcodes
include( plugin_dir_path( __FILE__ ) . 'includes/shortcodes.php');	


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
	$starting_date = get_post_meta($post->ID, 'starting_date', true);
	$increment_number = get_post_meta($post->ID, 'increment_number', true);	
	$counters_description = get_post_meta($post->ID, 'counters_description', true);
	$kwh_number_title = get_post_meta($post->ID, 'kwh_number_title', true);
	$show_counter_title = get_post_meta($post->ID, 'show_counter_title', true);
	$widget_id = get_post_meta($post->ID, 'widget_id', true);

?>
	<div id="counter_widgets">

		<ul>
			<li>
			<label>Cumulative Generation Title:</label>
				<input name="kwh_number_title" type="text" value="<?php echo (isset($kwh_number_title) ? $kwh_number_title : ''); ?>" /><br>
			</li>
			<li><label>Show Counter Title:</label>
				<input name="show_counter_title" type="checkbox" value="1" <?php checked( $show_counter_title, 1); ?>/><br>
				</li>
			<li>
			<label>Starting Generation Number:</label>
				<input name="starting_number" id="startingNumber" type="number" value="<?php echo (isset($starting_number) ? $starting_number : ''); ?>" /><br>
			</li>
			<li>
			<label>From Date:</label>
				<input name="starting_date" id="startingDate" type="date" value="<?php echo (isset($starting_date) ? $starting_date : ''); ?>" /><br>
			</li>

			<li><label>Increment / Seconds:</label>
				<input name="increment_number" id="incrementNumber" type="number" step="any" value="<?php echo (isset($increment_number) ? $increment_number : ''); ?>" /><br>
			</li>
			<li>
				<label># of Widgets: </label>
									
				<select name="widget_id" id="widget_id" onchange="changeWidgets(savings_number)"> 
						
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
		

		<div id="widget_settings">

			<label>Shortcodes:</label>
			<p>Copy and paste this code in any page or post you want to show the total Kwh Generated.</p>
			<?php echo isset($post->post_title) ? '<code>[counter-widget-kwh title="' . $post->post_title . '"]</code>' : ''?><br><br>
			<p>Copy and paste this code in any page or post you want to show this counter on.</p>
			<?php echo isset($post->post_title) ? '<code>[counter-widget title="' . $post->post_title . '"]</code>' : ''?><br><br>
			

			<div id="widget_list">

			</div>



		</div>					

		<script type="text/javascript">				

				
				let showWidgets = document.getElementById("widget_list");
				let widgetID = document.getElementById("widget_id").value;
				widgetID = parseInt(widgetID);
					
	
				<?php
						$start_date = strtotime($starting_date);
						$now_date = strtotime("now");	
						$starting_number = floatval($starting_number);					
						$increment_number = floatVal($increment_number);	
						$differenceSeconds = $now_date - $start_date;				
						$savings_number = ( ($differenceSeconds * $increment_number) + $starting_number);
					?>

					function getSavedMeta(){
						
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
					}

				
					function changeWidgets(){

						let showWidgets = document.getElementById("widget_list");
						let widgetID = document.getElementById("widget_id").value;
						widgetID = parseInt(widgetID);

						if( isNaN(widgetID) === false){

							newWidgets = '';

							let number = 1;

							for (number;number<widgetID+1;number++) { 		
									
								if(number == 1){
									newWidgets = '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo (isset($name_widget1) ? $name_widget1 : ''); ?>" type="text" /><br></li><li><label>Amount:</label><div id="tickerNum'+number+'" class="tickerNum"><?php echo $savings_number; ?></div><span> x </span><input name="amt_widget'+number+'" id="amt_widget'+number+'" class="amt_widget" value="<?php echo (isset($amt_widget1) ?  sprintf($amt_widget1) : ''); ?>" type="number" step="any" /><span> = </span><div id="totalAmt'+number+'" class="totalAmt" name="totalAmt'+number+'"><?php echo (isset($totalamt1) ?  number_format($totalamt1) : ''); ?></div></li><li><label>Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo (isset($animation1) ? $animation1 : ''); ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo (isset($image_url1) ? $image_url1 : ''); ?>" /><input type="hidden" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo (isset($image_id1) ? $image_id1 : ''); ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
								} else if(number == 2){
									newWidgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo (isset($name_widget2) ? $name_widget2 : ''); ?>" type="text" /><br></li><li><label>Amount:</label><div id="tickerNum'+number+'" class="tickerNum"><?php echo $savings_number; ?></div><span> x </span><input name="amt_widget'+number+'" id="amt_widget'+number+'" class="amt_widget" value="<?php echo (isset($amt_widget2) ?  sprintf($amt_widget2) : ''); ?>" type="number" step="any" /><span> = </span><div id="totalAmt'+number+'" class="totalAmt" name="totalAmt'+number+'"><?php echo (isset($totalamt2) ?  number_format($totalamt2) : ''); ?></div></li><li><label>Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo (isset($animation2) ? $animation2 : ''); ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo (isset($image_url2) ? $image_url2 : ''); ?>" /><input type="hidden" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo (isset($image_id2) ? $image_id2 : ''); ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
								} else if(number == 3){
									newWidgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo (isset($name_widget3) ? $name_widget3 : ''); ?>" type="text" /><br></li><li><label>Amount:</label><div id="tickerNum'+number+'" class="tickerNum"><?php echo $savings_number; ?></div><span> x </span><input name="amt_widget'+number+'" id="amt_widget'+number+'" class="amt_widget" value="<?php echo (isset($amt_widget3) ?  sprintf('%.9F',$amt_widget3) : ''); ?>" type="number" step="any" /><span> = </span><div id="totalAmt'+number+'" class="totalAmt" name="totalAmt'+number+'"><?php echo (isset($totalamt3) ?  number_format($totalamt3) : ''); ?></div></li><li><label>Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo (isset($animation3) ? $animation3 : ''); ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo (isset($image_url3) ? $image_url3 : ''); ?>" /><input type="hidden" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo (isset($image_id3) ? $image_id3 : ''); ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
								} else {
									newWidgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo (isset($name_widget4) ? $name_widget4 : ''); ?>" type="text" /><br></li><li><label>Amount:</label><div id="tickerNum'+number+'" class="tickerNum"><?php echo $savings_number; ?></div><span> x </span><input name="amt_widget'+number+'" id="amt_widget'+number+'" class="amt_widget" value="<?php echo (isset($amt_widget4) ?  sprintf($amt_widget4) : ''); ?>" type="number" step="any" /><span> = </span><div id="totalAmt'+number+'" class="totalAmt" name="totalAmt'+number+'"><?php echo (isset($totalamt4) ?  number_format($totalamt4) : ''); ?></div></li><li><label>Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo (isset($animation4) ? $animation4 : ''); ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo (isset($image_url4) ? $image_url4 : ''); ?>" /><input type="hidden" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo (isset($image_id4) ? $image_id4 : ''); ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
								}

							}


						} else {
							
							newWidgets = '<ul><li>Select the number of widgets from the dropdown</li></ul>';
						}

						showWidgets.innerHTML = newWidgets;
		
					}
									
					<?php
					$widget_id_int = (int) $widget_id;
					$amt_widget1 = (float)$amt_widget1;
					$amt_widget2 =  (float)$amt_widget2;
					$amt_widget3 =  (float)$amt_widget3;			
					$amt_widget4 =  (float)$amt_widget4;

					if($widget_id_int < 2){
						$totalamt1 = round($savings_number * $amt_widget1);

					} else if($widget_id_int < 3){
						$totalamt1 = round($savings_number * $amt_widget1);
						$totalamt2 = round($savings_number * $amt_widget2);
					} else if($widget_id_int < 4){
						$totalamt1 = round($savings_number * $amt_widget1);
						$totalamt2 = round($savings_number * $amt_widget2);
						$totalamt3 = round($savings_number * $amt_widget3);
					} else {
						$totalamt1 = round($savings_number * $amt_widget1);
						$totalamt2 = round($savings_number * $amt_widget2);
						$totalamt3 = round($savings_number * $amt_widget3);
						$totalamt4 = round($savings_number * $amt_widget4);
					}
					?>
	
				if( isNaN(widgetID) === false){ 

					widgets = '';

					getSavedMeta();

					let number = 1;

					for (number;number<widgetID+1;number++) { 
										
							if(number == 1){
								widgets = '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo (isset($name_widget1) ? $name_widget1 : ''); ?>" type="text" /><br></li><li><label>Amount:</label><div id="tickerNum'+number+'" class="tickerNum"><?php echo isset($savings_number) ? $savings_number : ''; ?></div><span> x </span><input name="amt_widget'+number+'" id="amt_widget'+number+'" class="amt_widget" value="<?php echo (isset($amt_widget1) ? sprintf($amt_widget1) : ''); ?>" type="number" step="any" /><span> = </span><div id="totalAmt'+number+'" class="totalAmt" name="totalAmt'+number+'"><?php echo isset($totalamt1) ? number_format($totalamt1) : ''; ?></div></li><li><label>Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo (isset($animation1) ? $animation1 : ''); ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo (isset($image_url1) ? $image_url1 : ''); ?>" /><input type="hidden" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo (isset($image_id1) ? $image_id1 : ''); ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else if(number == 2){
								widgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo (isset($name_widget2) ? $name_widget2 : ''); ?>" type="text" /><br></li><li><label>Amount:</label><div id="tickerNum'+number+'" class="tickerNum"><?php echo isset($savings_number) ? $savings_number : ''; ?></div><span> x </span><input name="amt_widget'+number+'" id="amt_widget'+number+'" class="amt_widget" value="<?php echo (isset($amt_widget2) ?  sprintf($amt_widget2) : ''); ?>" type="number" step="any" /><span> = </span><div id="totalAmt'+number+'" class="totalAmt" name="totalAmt'+number+'"><?php echo (isset($totalamt2) ?  number_format($totalamt2) : ''); ?></div></li><li><label>Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo (isset($animation2) ? $animation2 : ''); ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo (isset($image_url2) ? $image_url2 : ''); ?>" /><input type="hidden" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo (isset($image_id2) ? $image_id2 : ''); ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else if(number == 3){
								widgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo (isset($name_widget3) ? $name_widget3 : ''); ?>" type="text" /><br></li><li><label>Amount:</label><div id="tickerNum'+number+'" class="tickerNum"><?php echo isset($savings_number) ? $savings_number : ''; ?></div><span> x </span><input name="amt_widget'+number+'" id="amt_widget'+number+'" class="amt_widget" value="<?php echo (isset($amt_widget3) ?  sprintf('%.9F',$amt_widget3) : ''); ?>" type="number" step="any" /><span> = </span><div id="totalAmt'+number+'" class="totalAmt" name="totalAmt'+number+'"><?php echo (isset($totalamt3) ?  number_format($totalamt3) : ''); ?></div></li><li><label>Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo (isset($animation3) ? $animation3 : ''); ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo (isset($image_url3) ? $image_url3 : ''); ?>" /><input type="hidden" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo (isset($image_id3) ? $image_id3 : ''); ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							} else {
								widgets += '<ul><li><label>Name:</label><input name="name_widget'+number+'" value="<?php echo (isset($name_widget4) ? $name_widget4 : ''); ?>" type="text" /><br></li><li><label>Amount:</label><div id="tickerNum'+number+'" class="tickerNum"><?php echo isset($savings_number) ? $savings_number : ''; ?></div><span> x </span><input name="amt_widget'+number+'" id="amt_widget'+number+'" class="amt_widget" value="<?php echo isset($amt_widget4) ? sprintf($amt_widget4) : ''; ?>" type="number" step="any" /><span> = </span><div id="totalAmt'+number+'" class="totalAmt" name="totalAmt'+number+'"><?php echo (isset($totalamt4) ?  number_format($totalamt4) : ''); ?></div></li><li><label>Image:</label><br><br><textarea class="widefat" id="animation'+number+'" name="animation'+number+'" ><?php echo (isset($animation4) ? $animation4 : ''); ?></textarea></li><li class="animation_image"><label>Image:</label><input type="text" name="image_url'+number+'" class="image_url'+number+'" value="<?php echo (isset($image_url4) ? $image_url4 : ''); ?>" /><input type="hidden" name="image_id'+number+'" class="image_id'+number+'" value="<?php echo (isset($image_id4) ? $image_id4 : ''); ?>" /><input class="my_clear_button'+number+'" type="button" value="Clear" /><input class="my_upl_button'+number+'" type="button" value="Upload File" /></li></ul>';
							}

					}

				} else {

					widgets = '<ul><li>Select the number of widgets from the dropdown and click the save/update button</li></ul>';

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

		if( isset($_POST['kwh_number_title']) ){
			update_post_meta($post_id, "kwh_number_title", $_POST["kwh_number_title"]);
		}
		if( isset($_POST['show_counter_title']) ){
			update_post_meta($post_id, "show_counter_title", true);
		} else {
			update_post_meta($post_id, "show_counter_title", false);
		}
		
		if( isset($_POST['starting_number']) ){
			update_post_meta($post_id, "starting_number", $_POST["starting_number"]);
		}
		
		if( isset($_POST['starting_date']) ){
			update_post_meta($post_id, "starting_date", $_POST["starting_date"]);
		}	

		if( isset($_POST['increment_number']) ){
			update_post_meta($post_id, "increment_number", $_POST["increment_number"]);
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