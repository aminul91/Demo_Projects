<?php

/*
Plugin Name: tutor link
Plugin URI: https://tutorsitelinks.herokuapp.com/

Description: Plugin for Rest API with different tutorials link 
Author: Md Aminul Islam
Author URI: https://mdaminul.info/
Version: 1.1

*/

register_activation_hook(__FILE__,'tutor_link_activate');                       //activated via hook
register_deactivation_hook(__FILE__,'tutor_link_deactivate');
function tutor_link_activate(){

};
 
function tutor_link_deactivate(){
	echo"Deactivated";
};

add_action('admin_menu','tutor_link_menu');                      // Add plugin at left menu

function tutor_link_menu(){
	add_menu_page('tutor data','tutor data',8,__FILE__,'tutor_data_list');  // define plugin name at left menu
	

}

add_shortcode('tutor_data_list_shortcode','tutor_data_list');

function tutor_data_list(){
	
	include('data_view.php');
	

}



?>
