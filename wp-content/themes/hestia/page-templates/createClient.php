<?php
/*Template Name: Create Client */?>
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
            <form id="form_action">
                <div class="container mb-5 mt-5">
                    <div class="form-outline">
                        <label class="form-label" for="typeText">Client Name</label>
                        <input type="text" id="clientName" name="clientName" class="form-control" />
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="typeEmail">Client Email Id</label>
                        <input type="email" id="clientEmail" name="clientEmail" class="form-control" />
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="typePhone">Phone number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" />
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="typeText">Address</label>
                        <input type="text" id="address" name="address" class="form-control" />
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="typeText">City</label>
                        <input type="text" id="city" name="city" class="form-control" />
                    </div>
                    <button type="button" id="submit">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        jQuery('#submit').on('click', function () {
            // alert('submit button works');
            event.preventDefault();
            var clientName = jQuery('#clientName').val();
            var clientEmail = jQuery('#clientEmail').val();
            var phone = jQuery('#phone').val();
            var address = jQuery('#address').val();
            var city = jQuery('#city').val();

            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() ?>/page-templates/createClientAjax.php',
                type: 'POST',
                data: {
                    clientName: clientName,
                    clientEmail: clientEmail,
                    phone: phone,
                    address: address,
                    city: city,
                    action: 'form-submit'
                },
                success: function () {
                    alert('data has been submitted');
                    document.getElementById("form_action").reset();
                },
            })


        })
    })
</script>
<?php get_footer(); ?>