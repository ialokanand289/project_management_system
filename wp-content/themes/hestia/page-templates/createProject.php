<?php
/* Template Name: Create Project  */
?>

<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Hestia
 * @since Hestia 1.0
 */
global $wpdb;
$sql = "SELECT `id`,`clientName` FROM wp_project_management_systemcreateclient";
$result = $wpdb->get_results($sql);
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
            <form id="form_act">
                <div class="container mb-5 mt-5">
                    <div class="form-outline">
                        <label class="form-label" for="typeText">Project Name</label>
                        <input type="text" id="projectName" name="projectName" class="form-control" />
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="typeText">Description</label>
                        <input type="text" id="desc" name="desc" class="form-control" />
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="typeText">Invoice Tenor (In Months)</label>
                        <input type="text" id="invoiceTenor" name="invoiceTenor" class="form-control" />
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="typeText">Amount of Tenor (Per Months)</label>
                        <input type="text" id="amount" name="amount" class="form-control" />
                    </div>
                    
                    <label for="text">Client Name</label>
                    <select name="client_id" id="client_id">
                        <option value="">Select Client Name</option>
                        <?php
                        global $wpdb;
                        $result = $wpdb->get_results("SELECT `id`,`clientName` FROM wp_project_management_systemcreateclient");
                        foreach ($result as $row) {
                            $id_drop = $row->id;
                            $name_drop = $row->clientName;
                            echo '<option value = ' . $id_drop . '>' . $name_drop . '</option>';
                        }
                        ?>

                    </select>
                    <br><br>
                    <div class="form-outline">
                        <label class="form-label" for="typeText">Assign Date</label>
                        <input type="date" id="startDate" name="startDate" class="form-control" />
                    </div>
                    <button type="button" id="submit">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        jQuery("#submit").on('click', function () {
            event.preventDefault();
            var projectName = jQuery("#projectName").val();
            var desc = jQuery("#desc").val();
            var invoiceTenor = jQuery("#invoiceTenor").val();
            var amount = jQuery("#amount").val();
            var client_id = jQuery("#client_id").val();
            var startDate = jQuery("#startDate").val();


            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() ?>/page-templates/createProjectAjax.php',
                method: 'POST',
                data: {
                    projectName: projectName,
                    desc: desc,
                    invoiceTenor: invoiceTenor,
                    amount: amount,
                    client_id: client_id,
                    startDate : startDate,
                    action: 'form-submit'
                },
                success: function () {
                    alert("data submitted");
                    document.getElementById("form_act").reset();
                },
            })

        })
    })


</script>
<?php get_footer(); ?>