<?php
global $wpdb;
global $table_prefix;
$table = $table_prefix.'form_data';
$sql = "SELECT `projectName`, `startDate`,`clientName` FROM wp_project_management_systemcreateproject AS p
LEFT JOIN wp_project_management_systemcreateclient AS c 
ON p.client_id = c.id;";
$result = $wpdb->get_results($sql);

?>

<table>
  <thead>
    <tr>
      <th scope="col">Project Name</th>
      <th scope="col">Assign Date</th>
      <th scope="col">Client Name</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $list) {?>
    <tr>
      
      <td><?=$list->projectName;?></td>
      <td><?=$list->startDate;?></td>
      <td><?=$list->clientName;?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>