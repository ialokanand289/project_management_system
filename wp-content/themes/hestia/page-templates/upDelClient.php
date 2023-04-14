<?php
/*Template Name: Update Client */?>

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
                                            <th>Client Name</th>
                                            <th>Client Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>City</th>
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

            </div>
            <div class="container">
                <table class="table table-bordered border-primary" id="table_id">
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

                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script>
    // delete data
    jQuery(document).ready(function () {
        jQuery(".delete-btn").on('click', function () {
            event.preventDefault();
            // alert('button worked');
            var del_data = jQuery(this).data('id');
            var element = this;
            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() ?>./page-templates/up_del_ajax.php',
                method: 'POST',
                data: {
                    id: del_data,
                    action: 'delete-action'
                },
                success: function (result) {
                    console.log(result);
                    alert('Data Deleted Successfully');
                    jQuery(element).closest('tr').fadeOut();
                }
            });
        });

        //edit data show modal box
        jQuery(".edit-btn").on('click', function () {
            // jQuery("#myModal").show();
            var edit_data = jQuery(this).data('e_id');
            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() ?>./page-templates/up_del_ajax.php',
                method: 'POST',
                data: {
                    id: edit_data,
                    action : 'edit-form'
                },
                success: function (data) {
                    jQuery("#myModal table").html(data);
                    // alert('Data Updated Successfully');
                }
            })
        });



        //save and update modal data in databases
        jQuery("#save_edit").on('click', function(){
            
            var ids =jQuery("#new_id").val();
            var new_client = jQuery("#n_clientName").val();
            var new_email = jQuery("#n_clientEmail").val();
            var new_phone = jQuery("#n_phone").val();
            var new_address = jQuery("#n_address").val();
            var new_city = jQuery("#n_city").val();
            // var element = this;
            jQuery.ajax({
                url:'<?php echo get_template_directory_uri() ?>./page-templates/up_del_ajax.php',
                method : 'POST',
                data : {
                    id : ids,
                    clientName: new_client,
                    clientEmail: new_email,
                    phone : new_phone,
                    address  : new_address,
                    city : new_city,
                    action : 'save-form'
                },
                success:function(data){
                    //load data of table 
                    jQuery.ajax({
                        url:'<?php echo get_template_directory_uri() ?>./page-templates/up_del_ajax.php',
                        method : 'POST',
                        data: {
                            action : 'load-data'
                        },
                        success: function(data){
                            // console.log(data);
                          
                            jQuery("#table_id").html(data);
                        }
                    })
                    alert("data saved Successfully");
                    
                }
            })
        })

    });

</script>
<?php get_footer(); ?>