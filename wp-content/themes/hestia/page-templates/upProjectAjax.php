<?php
global $wpdb;
require_once($_SERVER['DOCUMENT_ROOT'] . '/project_management_system/wp-load.php');

//save button modal
if (isset($_POST['action']) && $_POST['action'] == 'save-form') {
    // print_r($_POST);
    // exit;
    $id = $_POST['id'];
    $projectName = $_POST['projectName'];
    $desc = $_POST['desc'];
    $invoiceTenor = $_POST['invoiceTenor'];
    $amount = $_POST['amount'];
    $client_id = $_POST['client_id'];
    $date = date_create($_POST['startDate']);
    $startDate = date_format($date, "Y-m-d");

    $wpdb->update(
        'wp_project_management_systemcreateproject',
        array(
            "projectName" => $projectName,
            "desc" => $desc,
            "invoiceTenor" => $invoiceTenor,
            "amount" => $amount,
            "client_id" => $client_id,
            "startDate" => $startDate,
        ),
        array('p_id' => $id)
    );
    return $wpdb;
}

if (isset($_POST['action']) && $_POST['action'] == 'edit-form') {
    global $wpdb;

    $get_id = $_POST['id'];
    $result = $wpdb->get_results("SELECT * , c.id as c_id FROM wp_project_management_systemcreateproject as p left join wp_project_management_systemcreateclient as c on c.id = p.client_id WHERE `p_id` = '" . $get_id . "'"); ?>
    <thead>
        <tr>
            <th>Id</th>
            <th>Project Name</th>
            <th>Description</th>
            <th>Invoice Tenor</th>
            <th>Amount</th>
            <th>Client Name</th>
            <th>Assign Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $value) { ?>
            <tr>

                <td><input type="text" id="new_id" name="new_id" value="<?= $value->p_id; ?>"><br></td>
                <td><input type="text" id="n_projectName" name="n_projectName" value="<?= $value->projectName; ?>"><br></td>
                <td><input type="text" id="n_desc" name="n_desc" value="<?= $value->desc; ?>"><br></td>
                <td><input type="text" id="n_invoiceTenor" name="n_invoiceTenor" value="<?= $value->invoiceTenor; ?>"><br></td>
                <td><input type="text" id="n_amount" name="n_amount" value="<?= $value->amount; ?>"><br></td>
                <td><select name="n_client_id" id="n_client_id" value="<?= $value->c_id; ?>">
                        <option value="">Select Client Name</option>
                        <?php
                        global $wpdb;
                        $result = $wpdb->get_results("SELECT `id`,`clientName` FROM wp_project_management_systemcreateclient");
                        foreach ($result as $row) {
                            $id_drop = $row->id;
                            $name_drop = $row->clientName; ?>

                            <option value='<?= $id_drop ?>' <?= ($value->c_id == $row->id) ? "selected" : "" ?>><?= $name_drop ?>
                            </option>
                        <?php }
                        ?>

                    </select>
                    <br><br>
                <td><input type="text" id="n_startDate" name="n_startDate" value="<?= $value->startDate; ?>"><br></td>
                </td>

            </tr>
        <?php } ?>
    </tbody>
    <?php
    exit;
} ?>

<?php
//load table
if (isset($_POST['action']) && $_POST['action'] == 'load-data') { ?>
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Project Name</th>
            <th scope="col">Description</th>
            <th scope="col">Invoice Tenor</th>
            <th scope="col">Amount</th>
            <th scope="col">Client Name</th>
            <th scope="col">Assign Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM `wp_project_management_systemcreateproject` as p left join wp_project_management_systemcreateclient as c on p.client_id = c.id ");
        foreach ($result as $row) { ?>
            <tr>
                <td>
                    <?= $row->p_id; ?>
                </td>
                <td>
                    <?= $row->projectName; ?>
                </td>
                <td>
                    <?= $row->desc; ?>
                </td>
                <td>
                    <?= $row->invoiceTenor; ?>
                </td>
                <td>
                    <?= $row->amount; ?>
                </td>
                <td>
                    <?= $row->clientName ?? "No Client"; ?>
                </td>
                <td>
                    <?= $row->startDate; ?>
                </td>
                <td><button class="edit-btn" data-target="#myModal" data-toggle="modal"
                        data-e_id="<?= $row->p_id; ?>">Update</button></td>
            </tr>

        </tbody>
    <?php }
}
?>