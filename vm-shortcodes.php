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
    
 
       <span class="both">10</span> 
       <a onclick="check('nepal')" style="font-size:15px;">Both</a></a> <br>
       <span class="circle">1</span> 
       <a onclick="check('nepal')" style="font-size:15px;">Nepal</a></a> <br>
       <span class="circle2">2</span> 
       <a onclick="check('india')" style="font-size:15px;">India</a></a> <br>
       
  


    <section class="KBmap" id="KBtestmap">

    </section>
  
       <?php
//       global $wpdb;
//       $prefix = $wpdb->prefix;
//       $table_name = $prefix."vector_map";
//       $json_object = null;
//       $countrycount = $wpdb->get_results("SELECT country_name, COUNT(country_name) as country_count FROM $table_name GROUP BY country_name");
//
//       echo "<ui>";
//       foreach ($countrycount as $country){
//                $country_name = $country->country_name;
////                echo '<li onclick='filterCountry(\''.$country_name.'\')'>".$country_name."(".$country->country_count.")</li>';
//           echo '<li id="anything" onclick="filterCountry(\''.$country_name.'\')">'.$country_name.'('.$country->country_count.')</li>';
//
//       }
//    echo "</ui>"
?>
       <script>
        <?php
        global $wpdb;
        $prefix = $wpdb->prefix;
        $table_name = $prefix."vector_map";
        $json_object = null;
        $popups = $wpdb->get_results ("SELECT * FROM $table_name");


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
                        
                          <img src='".$profile."'>
                                    <p style='font-size: 12px !important;'>
                                    <span style='font-weight: bold; padding-top: 50px;'>Ihr Ansprechpartner:</span><br> 
                                    <span style='font-size: 12px !important; line-height: 20px;'>$popup->name </span><br><br>
                                    ".(!empty($popup->designation) ? "<span> $popup->designation </span>": "")."
                                    <span style='font-weight:bold;line-height: 20px;'>$popup->company_name</span>
                                    ".(!empty($popup->website) ? "<span >$popup->website </span>": "<br>")."
                                    ".(!empty($popup->street_name) ? "<span style='padding-top: 5px;'>$popup->street_name </span>": "")."<br style='margin-bottom: 1em;'>
                                    ".(!empty($popup->post_number) && !empty($popup->city_name) ? "<span style='padding-bottom: 50px;'>$popup->post_number, $popup->city_name </span>": "")."<br>
                                   ".(!empty($popup->phone) ? "<span style='line-height: 20px;'>Tel. $popup->phone </span><br>": "")."
                                   ".(!empty($popup->fax) ? "<span style='padding-bottom: 50px;'>Fax $popup->fax </span><br>": "")."
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

        (function($) {

$(document).ready(function(){
    var line = "<?php echo plugins_url( '../img/', __FILE__ )?>";
    console.log(line);
    onclicckline();

    // line.importJSON(json);



});


$(document).ready(function(){
    var line = "<?php echo plugins_url( '../img/', __FILE__ )?>";
    console.log(line);
    // myCity();

    // line.importJSON(json);



});
// $(document).ready(function(){
//   $("button").click(function(){
//     $(".nepalcities").toggleClass("marker");
//   });
// });
})(jQuery);
const nepalcities = ["Samakhusi"];
const indiacities = ["sandweg8","HirschbergerStraße","PfrondorferStr8"];
function check(country) {
		if (country === "nepal") {
            nepalcities.forEach(city => {
                $("this"+city).toggleClass("marker-active")
            })
            indiacities.forEach(city => {
                $("."+city).removeClass("marker-active")
            })
        }else if(country === "india"){
            indiacities.forEach(city => {
                $("."+city).toggleClass("marker-active")
            })
            nepalcities.forEach(city => {
                $("."+city).removeClass("marker-active")
            })

        }

		// $(document).ready(function(){
		//   $("button").click(function(){
		//     $(".nepalcities").toggleClass("marker");
		//   });
		// });
		// }

	}
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
