<?php
global $wpdb;
require_once($_SERVER['DOCUMENT_ROOT'] . '/project_management_system/wp-load.php');

if (isset($_POST['action']) && $_POST['action'] == 'form-submit') {

    $clientName = $_POST['clientName'];
    $clientEmail = $_POST['clientEmail'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $result = $wpdb->insert("wp_project_management_systemcreateclient", array(
        "clientName" => $clientName,
        "clientEmail" => $clientEmail,
        "phone" => $phone,
        "address" => $address,
        "city" => $city,
    )
    );

}
?>