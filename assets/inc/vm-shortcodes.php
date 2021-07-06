<?php 
/*
*
*	***** Vector Map  *****
*
*	Shortcodes
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
*
*  Build The Custom Plugin Form
*
*  Display Anywhere Using Shortcode: [vm_custom_plugin_form]
*
*/
function vm_custom_plugin_form_display(){

   if(!isset($_GET['action'])){
    ?>

    <section class="KBmap" id="KBtestmap">

        <script>

            function filterCountry(country_name){

                $( ".countryButton" ).click(function() {

                    // var cokvar = "clickedCountry = " + country_name +";";
                    //
                    // // alert(cokvar)
                    // document.cookie = cokvar;


                    // alert(document.cookie);
<!--                    --><?php
//                    $clickedCountry = 'Germany';
//
//                    global $wpdb;
//                    $prefix = $wpdb->prefix;
//                    $table_name = $prefix."vector_map";
//                    $json_object = null;
//
//                    if (isset($cname)){
//                        $popups = $wpdb->get_results ("SELECT * FROM $table_name WHERE country_name=$clickedCountry");
//                    }
//                    else{
//                        $popups = $wpdb->get_results ("SELECT * FROM $table_name");
//                    }
//
//                    if(count($popups) > 0) {
//                        foreach ($popups as $i => $popup) {
//                            $i = $i+1;
//                        }
//                        var_dump($popup);
//                    }
//                    ?>


                    $( ".KBmap__marker .marker" ).css('background', 'red');
                    // var clickedMarkerName = jQuery(this).parent().attr('data-marker-name');
                    // var clickedMarkerMapName = jQuery(this).parent().parent().parent().parent().attr('id');
                    // alert(clickedMarkerName);
                    // alert(clickedMarkerMapName);
                });

            }
        </script>

    </section>
       <?php
       global $wpdb;
       $prefix = $wpdb->prefix;
       $table_name = $prefix."vector_map";
       $json_object = null;
       $countrycount = $wpdb->get_results("SELECT country_name, COUNT(country_name) as country_count FROM $table_name GROUP BY country_name");

       echo "<ui class ='countryButton'>";
       foreach ($countrycount as $country){
                $country_name = $country->country_name;
//                echo '<li onclick='filterCountry(\''.$country_name.'\')'>".$country_name."(".$country->country_count.")</li>';
           echo '<li onclick="filterCountry(\''.$country_name.'\')">'.$country_name.'('.$country->country_count.')</li>';

       }
    echo "</ui>"
?>

       <script>
        <?php

        global $wpdb;
        $prefix = $wpdb->prefix;
        $table_name = $prefix."vector_map";
        $json_object = null;

        if (isset($cname)){
            $popups = $wpdb->get_results ("SELECT * FROM $table_name WHERE country_name=$cname");
        }
        else{
            $popups = $wpdb->get_results ("SELECT * FROM $table_name");
        }

        


        $baseurl  = wp_get_upload_dir();
        if(count($popups) > 0) {
            foreach ($popups as $i => $popup) {
                $i = $i+1;
                $path = plugins_url( '../img/graycolormarker.ico', __FILE__ );
                $profile = $baseurl['baseurl'].'/map-image/'.$popup->image;
                $cloudyurl = "https://res.cloudinary.com/demo/image/fetch/h_173,w_200/f_auto/";
                $mapMarker["mapMarker$i"] = [
                    'cordX'=>"$popup->coordinate_x",
                    'cordY'=>"$popup->coordinate_y",
                    'icon'=> $path,
                    'modal'=>[
                        "title" => "$popup->street_name",
                        "content" =>
                        "  
                        
                          <img src='".$profile."' width='200px' height='173px'>
                                    <p style='font-size: 12px !important;'>
                                    <span style='font-weight: bold;'>Ihr Ansprechpartner:</span><br> 
                                    <span style='font-size: 12px !important; line-height: 20px;'>$popup->name </span><br>
                                    ".(!empty($popup->designation) ? "<span> $popup->designation </span>": "")."
                                    <span style='font-weight:bold;line-height: 20px;''>$popup->company_name</span>
                                    ".(!empty($popup->website) ? "<span >$popup->website </span>": "<br>")."
                                    ".(!empty($popup->street_name) ? "<span style='padding-top: 5px;'>$popup->street_name </span>": "")."<br style='margin-bottom: 1em;'>
                                    ".(!empty($popup->post_number) && !empty($popup->city_name) ? "<span style='padding-bottom: 50px;'>$popup->post_number, $popup->city_name </span>": "")."<br>
                                   ".(!empty($popup->phone) ? "<span>Tel. $popup->phone </span><br>": "")."
                                   ".(!empty($popup->fax) ? "<span>Fax $popup->fax </span><br>": "")."
                                   ".(!empty($popup->email) ? "<span> $popup->email </span><br>": "")." 
                                   ".(!empty($popup->description) ? "<span> $popup->description </span>": "")."
                                   </p>"
                    ],
                ];
            }
        }

        ?>
        var json = <?php echo json_encode($mapMarker)?>;

        (function($) {

            $(document).ready(function(){
                var map_name = "<?php echo plugins_url( '../img/', __FILE__ )?>";

                createKBmap('KBtestmap', map_name+'/map.png');

                KBtestmap.importJSON(json);

                KBtestmap.showAllMapMarkers();

            });

        })(jQuery);

    </script>
    <?php
}
}
/*
Register All Shorcodes At Once
*/
add_action( 'init', 'vm_register_shortcodes');
function vm_register_shortcodes(){
	// Registered Shortcodes
	add_shortcode ('vm_map', 'vm_custom_plugin_form_display' );
};
