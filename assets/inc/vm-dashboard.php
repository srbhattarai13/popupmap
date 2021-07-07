<?php

// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if

function vm_dashboard(){
    global $wpdb;
    $prefix = $wpdb->prefix;
    $table_name = $prefix."vector_map";

//    $myPosts = $wpdb->get_row("SELECT * FROM $table_name");
////Add column if not present.
//    if(!isset($myPosts->street_name)){
//        $wpdb->query("ALTER TABLE $table_name ADD street_name VARCHAR (255) DEFAULT NULL ");
//        $wpdb->query("ALTER TABLE $table_name ADD post_number VARCHAR (255) DEFAULT NULL ");
//        $wpdb->query("ALTER TABLE $table_name ADD city_name VARCHAR (255) DEFAULT NULL ");
//        $wpdb->query("ALTER TABLE $table_name ADD country_name VARCHAR (255) DEFAULT NULL ");
//
//    }
    ?>
    <div class="container-fluid mt-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Vector Map</a>
        </nav>
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <?php
                    if (isset($_GET['edit'])){
                        $marker_id = $_GET['edit'];
//                        var_dump($marker_id);

                        $edit = $wpdb->get_row( "SELECT * FROM $table_name WHERE id = $marker_id");
//                        var_dump("SELECT * FROM $table_name WHERE id = {$marker_id}");die();
                    }

                    ?>
                    <div class="card-body" style="padding: 0px !important;">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="method" value="<?php echo  isset($_GET['edit']) ? 'update' : 'save' ?>">
                                <input type="hidden" class="form-control" name="id" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ""?>">
                                <label for="name"> Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo isset($edit) ? $edit->name : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="designation"> Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value="<?php echo isset($edit) ? $edit->designation : "" ?>">
                            </div>
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?php echo isset($edit) ? $edit->company_name : "" ?>" required>
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label for="location_name">Address</label>-->
<!--                                <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Address" value="--><?php //echo isset($edit) ? $edit->location_name : "" ?><!--" required>-->
<!--                            </div>-->
                            <div class="form-group">
                                <label for="website_url">Website URL</label>
                                <input type="text" class="form-control" id="website_url" name="website" placeholder="website Url" value="<?php echo isset($edit) ? $edit->website : "" ?>">
                            </div>
                            <div class="form-group">
                                <label for="street_name">Street</label>
                                <input type="text" class="form-control" id="street_name" name="street_name" placeholder="Street" value="<?php echo isset($edit) ? $edit->street_name : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="post_number">Post Number</label>
                                <input type="text" class="form-control" id="post_number" name="post_number" placeholder="Post Number" value="<?php echo isset($edit) ? $edit->post_number : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="city_name">City</label>
                                <input type="text" class="form-control" id="city_name" name="city_name" placeholder="City" value="<?php echo isset($edit) ? $edit->city_name : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="country_name">Country</label>
                                <input type="text" class="form-control" id="country_name" name="country_name" placeholder="Country" value="<?php echo isset($edit) ? $edit->country_name : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Tel</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Tel" value="<?php echo isset($edit) ? $edit->phone : "" ?>">
                            </div>
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax" placeholder="Fax" value="<?php echo isset($edit) ? $edit->fax : "" ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo isset($edit) ? $edit->email : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="coordinate_x">Coordinate X</label>
                                <input type="text" class="form-control" id="coordinate_x" name="coordinate_x" placeholder="Coordinate X" value="<?php echo isset($edit) ? $edit->coordinate_x : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="coordinate_y">Coordinate Y</label>
                                <input type="text" class="form-control" id="coordinate_y" name="coordinate_y" placeholder="Coordinate Y" value="<?php echo isset($edit) ? $edit->coordinate_y : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"><?php echo isset($edit) ? $edit->description : "" ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="popup_image" value="<?php echo isset($edit) ? $edit->image : "" ?>" >
                            </div>
                            <div class="form-group">
                                <input type="text" hidden class="form-control" id="prvimage" name="prvpopup_image" value="<?php echo isset($edit) ? $edit->image : "" ?>" >
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label for="image">Marker Image</label>-->
<!--                                <input type="file" class="form-control" id="marker_image" name="marker_image" value="--><?php //echo isset($edit) ? $edit->marker_image : "" ?><!--" >-->
<!--                            </div>-->
                            <input type="submit"  value="<?php echo isset($edit) ? "Update" : "Save" ?>" name="submit" class="btn btn-success" style="width: 100%">
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <section class="KBmap" id="KBtestmap"></section>
                <script>
                    <?php

                    $json_object = null;
                    $prefix = $wpdb->prefix;
                    $popups = $wpdb->get_results ("SELECT * FROM $table_name");
                    ?>
                    <?php
                    $baseurl  = wp_get_upload_dir();
                    if(count($popups) > 0) {
                        foreach ($popups as $i => $popup) {
                            $i = $i+1;
                            $path = plugins_url( '../img/graycolormarker.ico', __FILE__ );
                            $profile = $baseurl['baseurl'].'/map-image/'.$popup->image;
                            $mapMarker["mapMarker$i"] = [
                                'cordX'=>"$popup->coordinate_x",
                                'cordY'=>"$popup->coordinate_y",
                                'icon'=> $path,
                                'modal'=>[
                                    "title" => "$popup->street_name",
                                    "content" =>"
                                    <img src='".$profile."' width='200px' height='173px'>
                                    <p style='font-size: 12px !important;'>
                                    <span style='font-weight: bold;'>Ihr Ansprechpartner:</span><br> 
                                    <span style='font-size: 12px !important; line-height: 20px;'>$popup->name </span><br><br>
                                    ".(!empty($popup->designation) ? "<span> $popup->designation </span>": "")."
                                    <span style='font-weight:bold;line-height: 20px;''>$popup->company_name</span>
                                    ".(!empty($popup->website) ? "<span >$popup->website </span>": "<br>")."
                                    ".(!empty($popup->street_name) ? "<span style='line-height: 5px;'>$popup->street_name </span>": "")."<br>
                                    ".(!empty($popup->post_number) && !empty($popup->city_name) ? "<span style='line-height: 5px;'>$popup->post_number, $popup->city_name </span>": "")."<br>
                                   ".(!empty($popup->phone) ? "<span>Tel. $popup->phone </span>": "")."<br>

                                   ".(!empty($popup->fax) ? "<span>Fax $popup->fax </span>": "")."<br>
                                   ".(!empty($popup->email) ? "<span> $popup->email </span>": "")." <br>
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
                            console.log(map_name+'/map.png');
                            createKBmap('KBtestmap', map_name+'/map.png');

                            KBtestmap.importJSON(json);

                            KBtestmap.showAllMapMarkers();

                        });

                    })(jQuery);

                </script>
            </div>
            <table class="styled-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Company Name</th>
                    <th>Website URL</th>
                    <th>Street</th>
                    <th>Post Number</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Fax</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $table = null;
                $prefix = $wpdb->prefix;
                $results = $wpdb->get_results ( "SELECT * FROM $table_name");
                if(count($results) > 0){

                    foreach($results as $result){
                        $table .="<tr class=\"active-row\">";
                        $table .=" <td>".$result->name."</td>";
                        $table .=" <td>".$result->designation."</td>";
                        $table .=" <td>".$result->company_name."</td>";
                        $table .=" <td>".$result->website."</td>";
                        $table .=" <td>".$result->street_name."</td>";
                        $table .=" <td>".$result->post_number."</td>";
                        $table .=" <td>".$result->city_name."</td>";
                        $table .=" <td>".$result->country_name."</td>";
                        $table .=" <td>".$result->phone."</td>";
                        $table .=" <td>".$result->fax."</td>";
                        $table .=" <td>".$result->email."</td>";
                        $table .=" <td>".$result->description."</td>";
//                        var_dump($result->id);
                        $table .=" <td style='display: flex;'>
                                    <form action='' method='POST'>
                                    <input type='hidden' value='$result->id' name='delete_id'>
                                    <input type='submit' class='btn btn-danger' value='Delete' name='delete'>
                                    </form>
                                    <form action='' method='GET'>
                                    <input type='hidden' name='page' value='vm-main'>
                                    <input type='hidden' value='$result->id' name='edit'>
                                    <input type='submit' class='btn btn-primary' value='Edit' name='update'>
                                    </form>
                                    </td>";
                        $table .="</tr>";
                    }
                }
//                die();
                echo $table;
                ?>
                <!-- and so on... -->
                </tbody>
            </table>
        </div>
    </div>

    <?php
   if (isset($_POST['submit'])){
       if($_POST['method'] == "save"){
           $name            = $_POST['name'];
           $designation     = $_POST['designation'];
           $company_name    = $_POST['company_name'];
           $website         = $_POST['website'];
           $street_name   = $_POST['street_name'];
           $post_number   = $_POST['post_number'];
           $city_name   = $_POST['city_name'];
           $country_name   = $_POST['country_name'];
           $phone           = $_POST['phone'];
           $fax             = $_POST['fax'];
           $email           = $_POST['email'];
           $coordinate_x    = $_POST['coordinate_x'];
           $coordinate_y    = $_POST['coordinate_y'];
           $description     = $_POST['description'];

           $upload = wp_upload_dir();
           $upload_dir = $upload['basedir'];
           $upload_dir = $upload_dir . '/map-image';
           if (! is_dir($upload_dir)) {
               mkdir( $upload_dir, 0777 );
           }


           $filename = basename($_FILES['popup_image']['name']);
           $ext =  pathinfo($filename, PATHINFO_EXTENSION);
           $filename = "popup_".time().".$ext";
           $target_path = $upload_dir . "/" ."popup_". time().".$ext";
           move_uploaded_file($_FILES['popup_image']['tmp_name'], $target_path);
           //marker_image

           $upload_marker = wp_upload_dir();
           $upload_dir_marker = $upload['basedir'];
           $upload_dir_marker = $upload_dir_marker . '/map-image';
           if (! is_dir($upload_dir_marker)) {
               mkdir( $upload_dir_marker, 0777 );
           }
           $marker_image = basename($_FILES['marker_image']['name']);
           if ($marker_image){
               $ext =  pathinfo($marker_image, PATHINFO_EXTENSION);
               $marker_image = "marker_".time().".$ext";
               $target_path_marker = $upload_dir_marker . "/" ."marker_". time().".$ext";
               move_uploaded_file($_FILES['marker_image']['tmp_name'], $target_path_marker);
           }
           else{
               $marker_image = "graycolormarker.ico";
           }

           $status = $wpdb->insert($table_name, array(
                   'name' => $name,
                   'designation' => $designation,
                   'company_name' => $company_name,
                   'website' => $website,
                   'street_name' => $street_name,
                   'post_number' => $post_number,
                   'city_name' => $city_name,
                   'country_name' => $country_name,
                   'phone' => $phone,
                   'fax' => $fax,
                   'email' => $email,
                   'coordinate_x' => $coordinate_x,
                   'coordinate_y' => $coordinate_y,
                   'description' => $description,
                   'image' => $filename,
                   'marker_image' =>$marker_image,
               )
               ,array( '%s', '%s', '%s', '%s','%s', '%s','%s','%s','%s','%s','%s','%s'));
               echo "            
            <script>
                 location.reload();
            </script>
       ";
       }
       else if($_POST['method'] == "update"){
           $id            = $_POST['id'];
           $name            = $_POST['name'];
           $designation     = $_POST['designation'];
           $company_name    = $_POST['company_name'];
           $website         = $_POST['website'];
           $street_name   = $_POST['street_name'];
           $post_number   = $_POST['post_number'];
           $city_name   = $_POST['city_name'];
           $country_name   = $_POST['country_name'];
           $phone           = $_POST['phone'];
           $fax             = $_POST['fax'];
           $email           = $_POST['email'];
           $coordinate_x    = $_POST['coordinate_x'];
           $coordinate_y    = $_POST['coordinate_y'];
           $description     = $_POST['description'];
           $prvpopimage = $_POST['prvpopup_image'];

           $upload = wp_upload_dir();
           $upload_dir = $upload['basedir'];
           $upload_dir = $upload_dir . '/map-image';
           if (! is_dir($upload_dir)) {
               mkdir( $upload_dir, 0777 );
           }


           $filename = basename($_FILES['popup_image']['name']);

           if (!empty($filename)){
               $filename = $filename;
           }
           else{
               $filename = $prvpopimage;
           }

//           var_dump($filename);
//           var_dump($filename);

//           $ext =  pathinfo($filename, PATHINFO_EXTENSION);
//           var_dump($ext);
//           $filename = "popup_".".$ext";


           $target_path = $upload_dir . "/" .$filename;


           move_uploaded_file($_FILES['popup_image']['tmp_name'], $target_path);
           //marker_image
           $upload_marker = wp_upload_dir();
           $upload_dir_marker = $upload['basedir'];
           $upload_dir_marker = $upload_dir_marker . '/map-image';
           if (! is_dir($upload_dir_marker)) {
               mkdir( $upload_dir_marker, 0777 );
           }
           $marker_image = basename($_FILES['marker_image']['name']);
           if ($marker_image){
               $ext =  pathinfo($marker_image, PATHINFO_EXTENSION);
               $marker_image = "marker_".time().".$ext";
               $target_path_marker = $upload_dir_marker . "/" ."marker_". time().".$ext";
               move_uploaded_file($_FILES['marker_image']['tmp_name'], $target_path_marker);
           }
           else{
               $marker_image = "graycolormarker.ico";
           }

//           var_dump( array(
//               'name' => $name,
//               'designation' => $designation,
//               'company_name' => $company_name,
//               'website' => $website,
//               'location_name' => $location_name,
//               'phone' => $phone,
//               'fax' => $fax,
//               'email' => $email,
//               'coordinate_x' => $coordinate_x,
//               'coordinate_y' => $coordinate_y,
//               'description' => $description,
//               'image' => $filename,
//               'marker_image' =>$marker_image,
//           ));
//           die();
           $wpdb->update($table_name,
               array(
                   'name' => $name,
                   'designation' => $designation,
                   'company_name' => $company_name,
                   'website' => $website,
                   'street_name' => $street_name,
                   'post_number' => $post_number,
                   'city_name' => $city_name,
                   'country_name' => $country_name,
                   'phone' => $phone,
                   'fax' => $fax,
                   'email' => $email,
                   'coordinate_x' => $coordinate_x,
                   'coordinate_y' => $coordinate_y,
                   'description' => $description,
                   'image' => $filename,
                   'marker_image' =>$marker_image,
               ),
               array('id'=>$id));

           $redirect_url= admin_url('/admin.php?page=vm-main', 'http');
           echo "<script>location.href = '$redirect_url';</script>";
       }

   }
   if(isset($_POST['delete'])){
       Global $wpdb;
       $id = $_POST['delete_id'];
       $wpdb->get_results($wpdb->prepare("DELETE FROM $table_name WHERE `id` = {$id}"));
       
       echo "            
            <script>
                 location.reload();
            </script>
       ";
   }


}

