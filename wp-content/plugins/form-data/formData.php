<?php
/*
 * Plugin Name:       Form Data
 * Plugin URI:        https://management.com
 * Description:       A Plugin for adding data in the form.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Alok Anand
 * Author URI:        https://maangement.com
 * Text Domain:       management
*/

//adding hooks for activating and deactivating 
register_activation_hook(__FILE__, 'form_data_activate');
register_deactivation_hook(__FILE__, 'form_data_deactivate');

//activation of plugin
function form_data_activate(){
    global $wpdb;
    global $table_prefix;

    $table = $table_prefix.'form_data';
    $sql = "CREATE TABLE $table (
        `f_id` int(40) NOT NULL AUTO_INCREMENT,
        `projectName` varchar(255) NOT NULL,
        `clientName` varchar(255) NOT NULL,
        `add_on_date` date NOT NULL,
        `invoice_gen_date` date NOT NULL,
         PRIMARY KEY (`f_id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ";
    $wpdb->query($sql);
}



//deactivation of plugin
function form_data_deactivate()
{
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'form_data';
    $sql = "DROP TABLE `$table`";
    $wpdb->query($sql);
}

add_action('admin_menu', 'form_data_menu');


function form_data_menu()
{
    add_menu_page('Form Data', 'Form Data', 8, __FILE__, 'form_data_list');
}

add_shortcode('form_data_list_shortcode','form_data_list');
function form_data_list()
{
    include('form_data_list.php');
}