<?php
global $wpdb;
require_once($_SERVER['DOCUMENT_ROOT'] . '/project_management_system/wp-load.php');

if (isset($_POST['action']) && $_POST['action'] == 'delete-action') {

    $id = $_POST['id'];
    $wpdb->delete('wp_project_management_systemcreateclient', array('id' => $id));
}
?>
<?php
//save button
if (isset($_POST['action']) && $_POST['action'] == 'save-form') {


    $id = $_POST['id'];
    $clientName = $_POST['clientName'];
    $clientEmail = $_POST['clientEmail'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $wpdb->update(
        'wp_project_management_systemcreateclient',
        array(
            "clientName" => $clientName,
            "clientEmail" => $clientEmail,
            "phone" => $phone,
            "address" => $address,
            "city" => $city,
        ),
        array('id' => $id)
    );
    return $wpdb;
}

?>
<?php
if (isset($_POST['action']) && $_POST['action'] == 'load-data') {?>

    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Client Name</th>
            <th scope="col">Client Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">City</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM `wp_project_management_systemcreateclient`");
        foreach ($result as $row) { ?>
            <tr>
                <td>
                    <?= $row->id; ?>
                </td>
                <td>
                    <?= $row->clientName; ?>
                </td>
                <td>
                    <?= $row->clientEmail; ?>
                </td>
                <td>
                    <?= $row->phone; ?>
                </td>
                <td>
                    <?= $row->address; ?>
                </td>
                <td>
                    <?= $row->city; ?>

                </td>

                <td><button class="delete-btn" data-id="<?= $row->id; ?>">Delete</button>&nbsp
                                    &nbsp&nbsp<button class="edit-btn" data-target="#myModal" data-toggle="modal"
                                        data-e_id="<?= $row->id; ?>">Update</button></td>
            </tr>
        </tbody>
    <?php }

} ?>




<?php
if (isset($_POST['action']) && $_POST['action'] == 'edit-form') { 


$get_id = $_POST['id'];
$result = $wpdb->get_results("SELECT * FROM wp_project_management_systemcreateclient WHERE `id` = '" . $get_id . "'"); ?>
<thead>
    <tr>
        <th>Id</th>
        <th>Client Name</th>
        <th>Client Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>City</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($result as $value) { ?>
        <tr>

            <td><input type="text" id="new_id" name="new_id" value="<?= $value->id; ?>"><br></td>
            <td><input type="text" id="n_clientName" name="n_clientName" value="<?= $value->clientName; ?>"><br></td>
            <td><input type="text" id="n_clientEmail" name="n_clientEmail" value="<?= $value->clientEmail; ?>"><br></td>
            <td><input type="text" id="n_phone" name="n_phone" value="<?= $value->phone; ?>"><br></td>
            <td><input type="text" id="n_address" name="n_address" value="<?= $value->address; ?>"><br></td>
            <td><input type="text" id="n_city" name="n_city" value="<?= $value->city; ?>"><br></td>

        </tr>
    <?php } ?>
</tbody>
<?php
exit;
} ?>