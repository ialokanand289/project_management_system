<?php
global $wpdb;
require_once($_SERVER['DOCUMENT_ROOT'] . '/project_management_system/wp-load.php');

if (isset($_POST['action']) && $_POST['action'] == 'form-submit') {

    $projectName = $_POST['projectName'];
    $desc = $_POST['desc'];
    $invoiceTenor = $_POST['invoiceTenor'];
    $amount = $_POST['amount'];
    $client_id = $_POST['client_id'];
    $date= date_create($_POST['startDate']);
    $startDate = date_format($date,"Y-m-d");

    $result = $wpdb->insert("wp_project_management_systemcreateproject", array(
        "projectName" => $projectName,
        "desc" => $desc,
        "invoiceTenor" => $invoiceTenor,
        "amount" => $amount,
        "client_id" => $client_id,
        "startDate" => $startDate
    )
    );
}
?>