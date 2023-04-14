<?php
/* Template Name: Update Project  */
?>
<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

get_header();

do_action('hestia_before_single_page_wrapper');

?>
<div class="<?php echo hestia_layout(); ?>">
    <?php
    $class_to_add = '';
    if (class_exists('WooCommerce', false) && !is_cart()) {
        $class_to_add = 'blog-post-wrapper';
    }
    ?>
    <div class="blog-post <?php esc_attr($class_to_add); ?>">
        <div class="container">
            <?php
            if (have_posts()):
                while (have_posts()):
                    the_post();
                    get_template_part('template-parts/content', 'page');
                endwhile;
            else:
                get_template_part('template-parts/content', 'none');
            endif;
            ?>
            <div class="container">.
                <h2>Modal Example</h2>
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open
                    Modal</button>


                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="c">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped">
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



                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="save_edit"
                                    data-dismiss="modal">Save</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="container">
                    <table class="table table-bordered border-primary" id="table_id">
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
                                        <?= $row->startDate?>
                                    </td>
                                    <td><button class="edit-btn" data-target="#myModal" data-toggle="modal"
                                            data-e_id="<?= $row->p_id; ?>">Update</button></td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <script>
                    //display value into modal
                    jQuery(".edit-btn").on('click', function () {
                        // jQuery("#myModal").show();
                        var edit_data = jQuery(this).data('e_id');
                        jQuery.ajax({
                            url: '<?php echo get_template_directory_uri() ?>./page-templates/upProjectAjax.php',
                            method: 'POST',
                            data: {
                                id: edit_data,
                                action: 'edit-form'
                            },
                            success: function (data) {
                                jQuery("#myModal table").html(data);
                                // alert('Data Updated Successfully');
                            }
                        })


                        //save and edit modal
                        jQuery("#save_edit").on('click', function () {
                            var ids = jQuery("#new_id").val();
                            var new_projectName = jQuery("#n_projectName").val();
                            var new_desc = jQuery("#n_desc").val();
                            var new_invoiceTenor = jQuery("#n_invoiceTenor").val();
                            var new_amount = jQuery("#n_amount").val();
                            var new_client_id = jQuery("#n_client_id").val();
                            var new_startDate = jQuery("#n_startDate").val();
                            jQuery.ajax({

                                url: '<?php echo get_template_directory_uri() ?>./page-templates/upProjectAjax.php',
                                method: 'POST',
                                data: {
                                    id: ids,
                                    projectName: new_projectName,
                                    desc: new_desc,
                                    invoiceTenor: new_invoiceTenor,
                                    amount: new_amount,
                                    client_id: new_client_id,
                                    startDate: new_startDate,
                                    action: 'save-form'
                                },
                                success: function (data) {
                                    //load data of table 
                                    jQuery.ajax({
                                        url: '<?php echo get_template_directory_uri() ?>./page-templates/upProjectAjax.php',
                                        method: 'POST',
                                        data: {
                                            action: 'load-data'
                                        },
                                        success: function (data) {
                                            // console.log(data);

                                            jQuery("#table_id").html(data);
                                        }
                                    })
                                    alert('data Successfully save');
                                }
                            })
                        })
                    });


                </script>



            </div>
        </div>
    </div>
    <?php get_footer(); ?>