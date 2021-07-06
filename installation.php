<?php
//`street_name` varchar(255) DEFAULT NULL,
//		`post_number` varchar(255) DEFAULT NULL,
//		`city_name` varchar(255) DEFAULT NULL,
//		`country_name` varchar(255) DEFAULT NULL,
function vector_table(){
    Global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $gcpch_card_table  = $wpdb->prefix . 'vector_map';
    $vhwch_vtable = "CREATE TABLE $gcpch_card_table (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(255) DEFAULT NULL,
		`designation` varchar(255) DEFAULT NULL,
		`company_name` varchar(255) DEFAULT NULL,
		`website` varchar(255) DEFAULT NULL,
		
		`phone` varchar(255) DEFAULT NULL,
		`fax` varchar(255) DEFAULT NULL,
		`email` varchar(255) DEFAULT NULL,
		`coordinate_x` varchar(255) DEFAULT NULL,
		`coordinate_y` varchar(255) DEFAULT NULL,
		`description` varchar(255) DEFAULT NULL,
		`image` varchar(255) DEFAULT NULL,
		`marker_image` varchar(255) DEFAULT '../img/graycolormarker.ico',
		`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		`updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`)
	) $charset_collate;";


	
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($vhwch_vtable);


}

