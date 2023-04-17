<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/project_management_system/wp-load.php');

global $wpdb;
global $table_prefix;
$table = $table_prefix.'form_data';
$sql = "SELECT `projectName`, `startDate`,`clientName`,`p_id` FROM wp_project_management_systemcreateproject AS p
LEFT JOIN wp_project_management_systemcreateclient AS c 
ON p.client_id = c.id;";
$result = $wpdb->get_results($sql);
// print_r($_SESSION); 
?>

<table>
  <thead>
    <tr>
      <th scope="col">Project Name</th>
      <th scope="col">Assign Date</th>
      <th scope="col">Client Name</th>
      <th scope="col">Generate Invoice Button</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $list) {?>
    <tr>
      
      <td><?=$list->projectName;?></td>
      <td><?=$list->startDate;?></td>
      <td><?=$list->clientName;?></td>
      <td>
        <form action="<?= get_site_url() ?>/generate-invoice/" method="post" > 
          <input type="hidden" value="<?=$list->p_id;?>" name="g_id" > 
          <input type="submit" class="genButton" value="generate Invoice" >
    </form>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>