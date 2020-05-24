<div id="#custom-post-type-based-slider" class="py-3 px-5 row" style="background-color: #949599;">
    <div class="my-container col-12 text-white bg-white p-2">
        <?php
        $slides = array();
        // $posts_per_page = get_theme_mod('slider_posts_per_page');
        $post_type = get_theme_mod('slider_post_type');
        $post_ids = get_theme_mod('slider_post_ids');
        $args = array('post_type' => $post_type, 'post__in' => $post_ids);
        $slider_query = new WP_Query($args);
        if ($slider_query->have_posts()) {
            while ($slider_query->have_posts()) {
                $slider_query->the_post();
                // if (has_post_thumbnail()) {
                $temp = array();
                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
                $thumb_url = $thumb_url_array[0];
                $temp['title'] = get_the_title();
                $temp['excerpt'] = get_the_excerpt();
                $temp['permalink'] = get_the_permalink();
                $temp['image'] = $thumb_url;
                $slides[] = $temp;
                // }
            }
        }
        wp_reset_postdata();
        ?>

        <?php if (count($slides) > 0) { ?>

            <div id="carouselId" class="mx-auto carousel slide top-to-bottom" data-ride="carousel">
                <div class="carousel-inner" role="listbox">

                    <?php $i = 0;
                    foreach ($slides as $slide) {
                        extract($slide); ?>
                        <div class="carousel-item <?php if ($i == 0) { ?>active<?php } ?>">
                            <img class="img-fluid" src="<?php echo $image ?>" alt="<?php echo esc_attr($title); ?>" />
                            <div class="carousel-caption d-none d-md-block">
                                <h4><?php echo $title; ?></h4>
                                <p>
                                    <?php echo $excerpt; ?>
                                </p>
                            </div>
                        </div>
                    <?php $i++;
                    } ?>

                </div>
                <div class="carousel-control">
                    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <ol class="carousel-indicators">

                        <?php for ($i = 0; $i < count($slides); $i++) { ?>
                            <li data-target="#carouselId" data-slide-to="<?php echo $i ?>" <?php if ($i == 0) { ?>class="active" <?php } ?>></li>
                        <?php } ?>

                    </ol>
                    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

        <?php } ?>
    </div>
</div> <!-- #custom-post-type-based-slider -->