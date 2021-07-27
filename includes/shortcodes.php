<?php

/**
 * Do not load this file directly.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}


add_shortcode('counter-widget-kwh', 'pg_counter_widgets_display_kwh');

add_shortcode('counter-widget', 'pg_counter_widgets_display');

function pg_counter_widgets_display_kwh($atts = []){                   

    $widget_args = array(
                'post_type' => 'counter',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'post_status' => 'publish',
    );  
    $counters = get_posts($widget_args);


    if( $counters ){

        foreach($counters as $counter ){
                
            $atts = shortcode_atts( array(
                'title' => $counter->post_title,
                'limit' => 1,
            ), $atts );
                
            setup_postdata($counter);
                
            $kwh_number_title = get_post_meta($counter->ID, 'kwh_number_title', true); 
            $starting_number = get_post_meta($counter->ID, 'starting_number', true);
            $starting_date = get_post_meta($counter->ID, 'starting_date', true);	
            $increment_number = get_post_meta($counter->ID, 'increment_number', true);


        if($atts['title'] == $counter->post_title):
           
            $start_date = strtotime($starting_date);
            $now_date = strtotime("now");	
            $starting_number = floatval($starting_number);					
            $increment_number = floatVal($increment_number);	
            $differenceSeconds = $now_date - $start_date;				
            $savings_number = ( ($differenceSeconds * $increment_number) + $starting_number); 
            $savings_number = number_format(round($savings_number));


            if(isset($kwh_number_title)){
                $output1 = '<div class="counter_kwh" id="counter_kwh"><div class="counter_kwh_title"><h2>'.$kwh_number_title . '</h2></div>';
            } else {
                $output1 = '<div class="counter_kwh" id="counter_kwh">'; 
            }
                
            //return
            return  $output1 . '<div class="counter_kwh_total">' . $savings_number . ' kWh </div>
            </div>';

        endif;
        }
    }

}

function pg_counter_widgets_display($atts = []){                   

			$widget_args = array(
						'post_type' => 'counter',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
						'post_status' => 'publish',
			);
			$counters = get_posts($widget_args);


            if( $counters ){
	
    			foreach($counters as $counter ){
                        
                    $atts = shortcode_atts( array(
                        'title' => $counter->post_title,
                        'limit' => 1,
                    ), $atts );
                        
                    setup_postdata($counter);
                        
                    $starting_number = get_post_meta($counter->ID, 'starting_number', true);
                    $starting_date = get_post_meta($counter->ID, 'starting_date', true);	
                    $increment_number = get_post_meta($counter->ID, 'increment_number', true);
                    $counters_description = get_post_meta($counter->ID, 'counters_description', true);
                    $widget_id = get_post_meta($counter->ID, 'widget_id', true); 
                    $show_counter_title = get_post_meta($counter->ID, 'show_counter_title', true);


            if($atts['title'] == $counter->post_title):

                    if ($show_counter_title == '1'){

                        $output_1 = '<div class="counter" id="counter_widgets">
                            <div class="counter_title">
                            <h2>' . sprintf($counter->post_title) . '</h2>
                            </div> 
                            <div class="counter_description">
                            <p>' . sprintf($counters_description) . '</p>
                            </div> 
                            <div class="counter_w_grid aligncenter">                        
                            <div class="grid_container">';

                    } else {

                        $output_1 = '<div class="counter" id="counter_widgets">     
                            <div class="counter_description">
                            <p>' . sprintf($counters_description) . '</p>
                            </div> 
                            <div class="counter_w_grid aligncenter">                        
                            <div class="grid_container">';

                    }  
                    
                    
					$start_date = strtotime($starting_date);
					$now_date = strtotime("now");	
					$starting_number = floatval($starting_number);					
					$increment_number = floatVal($increment_number);	
					$differenceSeconds = $now_date - $start_date;				
					$savings_number = ( ($differenceSeconds * $increment_number) + $starting_number); 
                   
                    
                    if( $widget_id == 1){

                            
                        $name_widget1 = get_post_meta($counter->ID, 'name_widget1', true); 
                        $amt_widget1 = get_post_meta($counter->ID, 'amt_widget1', true);
                        $animation1 = get_post_meta($counter->ID, 'animation1', true);
                        $image_url1 = get_post_meta($counter->ID, 'image_url1', true); 				
                        $image_id1 = get_post_meta($counter->ID, 'image_id1', true); 

                        $amt_widget1 = floatval($amt_widget1);
                        $totalamt1 = round($savings_number * $amt_widget1); 
	
           
                        $output_2 = '<div class="counter_widget">
                            <div class="counter_w_image">
                            <img src="' . (($image_url1 !== '') ? $image_url1 : '') .  '" 
                            alt="' . $name_widget1 . '" />
                            </div>
                            <a href="javascript:void(0);"><div class="totalamt" id="totalAmt1">' .  $totalamt1 . '</div></a>
                            <div class="counter_w_title">
                            <h3>' . $name_widget1 . ' </h3>
                            </div>
                         </div>';
                     
                        } else if($widget_id == 2){
                          
                             $name_widget1 = get_post_meta($counter->ID, 'name_widget1', true); 
                             $name_widget2 = get_post_meta($counter->ID, 'name_widget2', true);                             
                             $amt_widget1 = get_post_meta($counter->ID, 'amt_widget1', true);
                             $amt_widget2 = get_post_meta($counter->ID, 'amt_widget2', true);
                             $animation1 = get_post_meta($counter->ID, 'animation1', true); 
                             $animation2 = get_post_meta($counter->ID, 'animation2', true);
                             $image_url1 = get_post_meta($counter->ID, 'image_url1', true); 
                             $image_url2 = get_post_meta($counter->ID, 'image_url2', true);                         
                             $image_id1 = get_post_meta($counter->ID, 'image_id1', true); 
                             $image_id2 = get_post_meta($counter->ID, 'image_id2', true); 

                             $amt_widget1 = floatval($amt_widget1);
                             $totalamt1 = round($savings_number * $amt_widget1);
                             

                             $amt_widget2 = floatval($amt_widget2);
                             $totalamt2 = round($savings_number * $amt_widget2);


                       
                               
 
                        $output_2 = '<div class="counter_widget"> 
                            <div class="counter_w_image">
                            <img src="' . (($image_url1 !== '') ? $image_url1 : '') . '" alt="' . $name_widget1 . '" />
                            </div>
                            <a href="javascript:void(0);"><div class="totalamt" id="totalAmt1">'. $totalamt1 . '</div></a>
                            <div class="counter_w_title">
                            <h3>' . $name_widget1 . '</h3>
                            </div>
                         </div>
                         <div class="counter_widget">
                            <div class="counter_w_image">
                                <img src="' . (($image_url2 !== '') ? $image_url2 : '') . '" alt="' . $name_widget2 . '" />
                            </div>
                            <a href="javascript:void(0);"><div class="totalamt" id="totalAmt2">' . $totalamt2 . '</div></a>
                            <div class="counter_w_title">
                            <h3>' .  $name_widget2 . '</h3>
                            </div>
                        </div>';

                       
    
                        } else if($widget_id == 3){
                          
                            $name_widget1 = get_post_meta($counter->ID, 'name_widget1', true);
                            $name_widget2 = get_post_meta($counter->ID, 'name_widget2', true);
                            $name_widget3 = get_post_meta($counter->ID, 'name_widget3', true);
                            $amt_widget1 = get_post_meta($counter->ID, 'amt_widget1', true);
                            $amt_widget2 = get_post_meta($counter->ID, 'amt_widget2', true);
                            $amt_widget3 = get_post_meta($counter->ID, 'amt_widget3', true);                            
                            $animation1 = get_post_meta($counter->ID, 'animation1', true); 
                            $animation2 = get_post_meta($counter->ID, 'animation2', true); 
                            $animation3 = get_post_meta($counter->ID, 'animation3', true); 
                            $image_url1 = get_post_meta($counter->ID, 'image_url1', true); 
                            $image_url2 = get_post_meta($counter->ID, 'image_url2', true); 
                            $image_url3 = get_post_meta($counter->ID, 'image_url3', true);
                            $image_id1 = get_post_meta($counter->ID, 'image_id1', true); 
                            $image_id2 = get_post_meta($counter->ID, 'image_id2', true); 
                            $image_id3 = get_post_meta($counter->ID, 'image_id3', true);

                            $amt_widget1 = floatval($amt_widget1);
                             $totalamt1 = round($savings_number * $amt_widget1);

                             $amt_widget2 = floatval($amt_widget2);
                             $totalamt2 = round($savings_number * $amt_widget2);

                             $amt_widget3 = floatval($amt_widget3);
                             $totalamt3 = round($savings_number * $amt_widget3);

 
  
                    
                             $output_2 =  '<div class="counter_widget">                               
                                <div class="counter_w_image">
                                <img src="' . (($image_url1 !== '') ? $image_url1 : '') . '"  alt="' . $name_widget1 . '" />
                                </div>
                                <a href="javascript:void(0);"><div class="totalamt" id="totalAmt1">' .  $totalamt1 . '</div></a>
                                <div class="counter_w_title">
                                <h3>' . $name_widget1 . '</h3>
                                </div>
                             </div>
                             <div class="counter_widget">                         
                                <div class="counter_w_image">
                                <img src="' . (($image_url2 !== '') ? $image_url2 : '') . '" 
                                alt="' . $name_widget2 . '" />
                                </div>
                                <a href="javascript:void(0);"><div class="totalamt" id="totalAmt2">' . $totalamt2 . '</div></a>
                                <div class="counter_w_title">
                                   <h3>' . $name_widget2 . '</h3>
                                </div>
                            </div>
                            <div class="counter_widget">                       
                                <div class="counter_w_image">
                                    <img src="' . (($image_url3 !== '') ? $image_url3 : '') . '" alt="' . $name_widget3 . '" />
                                </div>
                                <a href="javascript:void(0);"><div class="totalamt" id="totalAmt3">' .  $totalamt3 . '</div></a>
                                <div class="counter_w_title">
                                   <h3>' . $name_widget3 . '</h3>
                                </div>
                            </div>'; 
                       
           
                        } else {
  
                          
                             $name_widget1 = get_post_meta($counter->ID, 'name_widget1', true); 
                             $name_widget2 = get_post_meta($counter->ID, 'name_widget2', true); 
                             $name_widget3 = get_post_meta($counter->ID, 'name_widget3', true); 
                             $name_widget4 = get_post_meta($counter->ID, 'name_widget4', true); 
                             $amt_widget1 = get_post_meta($counter->ID, 'amt_widget1', true);
                             $amt_widget2 = get_post_meta($counter->ID, 'amt_widget2', true);
                             $amt_widget3 = get_post_meta($counter->ID, 'amt_widget3', true);
                             $amt_widget4 = get_post_meta($counter->ID, 'amt_widget4', true);
                             $animation1 = get_post_meta($counter->ID, 'animation1', true); 
                             $animation2 = get_post_meta($counter->ID, 'animation2', true); 
                             $animation3 = get_post_meta($counter->ID, 'animation3', true); 
                             $animation4 = get_post_meta($counter->ID, 'animation4', true); 
                             $image_url1 = get_post_meta($counter->ID, 'image_url1', true);
                             $image_url2 = get_post_meta($counter->ID, 'image_url2', true); 
                             $image_url3 = get_post_meta($counter->ID, 'image_url3', true); 
                             $image_url4 = get_post_meta($counter->ID, 'image_url4', true);
                             $image_id1 = get_post_meta($counter->ID, 'image_id1', true); 
                             $image_id2 = get_post_meta($counter->ID, 'image_id2', true); 
                             $image_id3 = get_post_meta($counter->ID, 'image_id3', true); 
                             $image_id4 = get_post_meta($counter->ID, 'image_id4', true); 

                             $amt_widget1 = floatval($amt_widget1);
                             $totalamt1 = round($savings_number * $amt_widget1); 
                         
                             $amt_widget2 = floatval($amt_widget2);
                             $totalamt2 = round($savings_number * $amt_widget2);

                             $amt_widget3 = floatval($amt_widget3);
                             $totalamt3 = round($savings_number * $amt_widget3);

                             $amt_widget4 = floatval($amt_widget4);
                             $totalamt4 = round($savings_number * $amt_widget4);
 
                            $output_2 =   '<div class="counter_widget">
                                 <div class="counter_w_image">
                                 <img src="' . (($image_url1 !== '') ? $image_url1 : '') . '" 
                                 alt="' . $name_widget1 . '" />
                                 </div>
                                 <a href="javascript:void(0);"><div class="totalamt" id="totalAmt1">' .  $totalamt1 . '</div></a>
                                 <div class="counter_w_title">
                                 <h3>' . $name_widget1 . '</h3>
                                 </div>
                              </div>
                              <div class="counter_widget">
                                 <div class="counter_w_image">
                                     <img src="' . (($image_url2 !== '') ? $image_url2 : '') . '" 
                                 alt="' . $name_widget2 . '" />
                                 </div>
                                 <a href="javascript:void(0);"><div class="totalamt" id="totalAmt2">' . $totalamt2 . '</div></a>
                                 <div class="counter_w_title">
                                 <h3>' . $name_widget2 . '</h3>
                                 </div>
                             </div>
                             <div class="counter_widget">
                                 <div class="counter_w_image">
                                     <img src="' .  (($image_url3 !== '') ? $image_url3 : '') . '" 
                                 alt="' . $name_widget3  . '" />
                                 </div>
                                 <a href="javascript:void(0);"><div class="totalamt" id="totalAmt3">' . $totalamt3 . '</div></a>
                                 <div class="counter_w_title">
                                 <h3>' . $name_widget3 . '</h3>
                                 </div>
                             </div>
                             <div class="counter_widget">
                                 <div class="counter_w_image">
                                     <img src="' .  (($image_url4 !== '') ? $image_url4 : '') . '" 
                                 alt="' . $name_widget4 . '" />
                                 </div>
                                 <a href="javascript:void(0);"><div class="totalamt" id="totalAmt4">' . $totalamt4 . '</div></a>
                                 <div class="counter_w_title">
                                 <h3>' . $name_widget4 . '</h3>
                                 </div>
                             </div>';


                        }   
                        
                        //return
                        return $output_1 . $output_2 . '</div></div></div>                        
                        <script type="text/javascript">
                        runAnimations();
                        </script>';

                endif;
                }
		}

}
?>