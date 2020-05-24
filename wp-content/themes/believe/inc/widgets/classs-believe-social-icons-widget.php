<?php
class Believe_Social_Icons_Widget extends WP_Widget
{
    public $default;
    public function __construct()
    {
        $args = array(
            'classname' => 'believe_social_icons_widget',
            'description' => __('display company social icon and links', 'believe'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('Believe_Social_Icons', __('Social Icons Widget', 'believe'), $args);
    }

    public function form($instance)
    {
        isset($instance['title']) ? $title = $instance['title'] : null;
        empty($instance['title']) ? $title = 'Social Profile' : null;

        $facebook = isset($instance['facebook']) ? $instance['facebook'] : null;
        $twitter = isset($instance['twitter']) ?  $instance['twitter'] : null;
        $linkedin = isset($instance['linkedin']) ? $instance['linkedin'] : null;
        $rss = isset($instance['rss']) ?  $instance['rss'] : null;

?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:') ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" name="<?php echo $this->get_field_name('title'); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php echo __('facebook:') ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook'); ?>" value="<?php echo $facebook; ?>" name="<?php echo $this->get_field_name('facebook'); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php echo __('twitter:') ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter'); ?>" value="<?php echo $twitter; ?>" name="<?php echo $this->get_field_name('twitter'); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php echo __('linkedin:') ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('linkedin'); ?>" value="<?php echo $linkedin; ?>" name="<?php echo $this->get_field_name('linkedin'); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php echo __('rss:') ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('rss'); ?>" value="<?php echo $rss; ?>" name="<?php echo $this->get_field_name('rss'); ?>">
        </p>
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        // var_dump($new_instance, $old_instance);
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook'])) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter'])) ? strip_tags($new_instance['twitter']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin'])) ? strip_tags($new_instance['linkedin']) : '';
        $instance['rss'] = (!empty($new_instance['rss'])) ? strip_tags($new_instance['rss']) : '';
        return $instance;
    }

    public function widget($args, $instance)
    {
        extract($instance);
        $title = apply_filters('widget-title', $instance['title']);
        $facebook = $instance['facebook'];
        $twitter = $instance['twitter'];
        $linkedin = $instance['linkedin'];
        $rss = $instance['rss'];

        $facebook_profile = '<a class="facebook" href="' . $facebook . '"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a> <br>';
        $twitter_profile = '<a class="twitter" href="' . $twitter . '"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a> <br>';
        $linkedin_profile = '<a class="linkedin" href="' . $linkedin . '"><i class="fa fa-linkedin" aria-hidden="true"></i>Linkedin Plus</a> <br>';
        $rss_profile = '<a class="rss" href="' . $rss . '"><i class="fa fa-rss" aria-hidden="true"></i>RSS</a> <br>';

        echo $args['before_widget'];
        if (!empty($facebook)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
    ?>
        <div class="social-icons">
            <?php
            echo (!empty($facebook)) ? $facebook_profile : null;
            echo (!empty($twitter)) ? $twitter_profile : null;
            echo (!empty($linkedin)) ? $linkedin_profile : null;
            echo (!empty($rss)) ? $rss_profile : null;
            ?>
        </div>
<?php
        echo $args['after_widget'];
    }
}


require_once ABSPATH . WPINC . '/class-wp-widget.php';
