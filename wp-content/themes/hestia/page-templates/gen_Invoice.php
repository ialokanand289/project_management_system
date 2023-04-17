<?php
/*Template Name: Generate Invoice */?>
<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

$projectId = 0;
if(isset($_POST['g_id'])){

  $projectId = $_POST['g_id'];


}


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
            <div class="container">
                <div class="card">

                    <div class="card-body">

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center"> Project Name</th>
                                        <th>Client Name</th>

                                        <th class="right">Invoice Tenor</th>
                                        <th class="center">Amount </th>
                                        <th class="right">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    global $wpdb;
                                    if($projectId == 0){
                                        $result = $wpdb->get_results("SELECT `projectName`, `clientName`, `invoiceTenor`, `amount` FROM wp_project_management_systemcreateproject AS p left join 
                                        wp_project_management_systemcreateclient AS c 
                                        ON p.client_id = c.id");

                                    }else{
                                        $result = $wpdb->get_results("SELECT `projectName`, `clientName`, `invoiceTenor`, `amount` FROM wp_project_management_systemcreateproject AS p left join 
                                        wp_project_management_systemcreateclient AS c 
                                        ON p.client_id = c.id where p.p_id = ".$projectId   );

                                    }

                                    
                                    
                                    foreach ($result as $key) { ?>


                                        <tr>
                                            <td class="center"><?= $key->projectName; ?></td>
                                            <td class="left strong"><?= $key->clientName; ?></td>
                                            <td class="left"><?= $key->invoiceTenor; ?></td>

                                            <td class="right"><?= $key->amount; ?></td>
                                            <td class="center"><?= $key->invoiceTenor * $key->amount; ?> </td>

                                        </tr>
                                    <?php }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">

                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>