<?php

/**
 * The template for displaying the front page
 *
 * This is the template that displays the front page when hompage is set to static page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Believe
 */

get_header();
?>
<?php

$children = get_children(['post_parent' => get_the_ID(), 'order' => 'ASC']);

?>
<main id="primary" class="site-main">

    <div class="row my-container py-4 child-pages">
        <div class="col-12">
            <div class="row">
                <div class="col-3 py-1 pl-0 border" style="background-color: #ebebeb;">
                    <ul class="nav nav-tabs flex-column card-header-tabs sidebar-menu text-uppercase" id="nav-tab" role="tablist">
                        <?php $a = 0;
                        foreach ($children as $child) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($a == 0) { ?>active<?php } ?>" id="nav-tab-<?php echo $a; ?>" data-toggle="tab" href="#tab-<?php echo $a; ?>" role="tab" aria-controls="tab-<?php echo $a; ?>"><?php echo $child->post_title; ?></a>
                            </li>
                        <?php $a++;
                        } ?>
                    </ul>
                </div>
                <div class="col-9 border p-3 child-sub-pages tab-content" id="tab-content">
                    <?php $i = 0;
                    foreach ($children as $child) { ?>
                        <?php $sub_pages = get_children(['post_parent' => $child->ID]); ?>
                        <div class="tab-pane <?php if ($i == 0) { ?>active fade show<?php } ?>" id="tab-<?php echo $i; ?>" role="tabpanel" aria-labelledby="tab-<?php echo $i; ?>">
                            <div class="row">
                                <?php
                                if (count($sub_pages) > 0) {
                                    $b = 0;
                                    foreach ($sub_pages as $page) { ?>
                                        <div class="col-md-4">
                                            <?php echo get_the_post_thumbnail($page); ?>
                                            <!-- <img src="" alt="image 1" class="img-fluid" /> -->
                                            <div class="title"><?php echo $page->post_title; ?></div>
                                            <p class="content">
                                                <?php echo get_the_excerpt($page); ?>
                                            </p>
                                        </div>
                                    <?php $b++;
                                    }
                                } else { ?>
                                    <div class="col-12">
                                        <p>This page has no sub-pages</p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php $i++;
                    } ?>
                </div>
            </div>
        </div>
    </div>

</main><!-- #main -->

<?php
get_footer();
