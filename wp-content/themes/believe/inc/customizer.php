<?php

/**
 * Believe Theme Customizer
 *
 * @package Believe
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function believe_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'believe_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'believe_customize_partial_blogdescription',
			)
		);
	}


	// $wp_customize->add_panel('believe_theme_options', array(
	// 	'title' => __('Theme Options'),
	// 	'description' => 'customizations for the wordpress theme', // Include html tags such as <p>.
	// 	'priority' => 105, // Mixed with top-level-section hierarchy.
	// ));

	believe_customize_slider_section($wp_customize);
	believe_customize_footer_section($wp_customize);
}
add_action('customize_register', 'believe_customize_register');


/**
 * add footer settings and controls
 *
 * @return void
 */
function believe_customize_slider_section($wp_customize)
{
	//post type
	$wp_customize->add_setting('slider_post_type', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
		'default' => 'post',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => '',
		'sanitize_js_callback' => '', // Basically to_json.
	));

	$post_types = get_post_types(array('public' => true, '_builtin' => true), 'names');
	$choices = array_combine($post_types, $post_types);

	$wp_customize->add_control('slider_post_type', array(
		'type' => 'select',
		'priority' => 10, // Within the section.
		'section' => 'believe_slider', // Required, core or custom.
		'label' => __('Post Type'),
		'description' => __('Post type to be displayed on the slider'),
		'choices' => $choices,
	));

	// // Post per page 
	// $wp_customize->add_setting('slider_posts_per_page', array(
	// 	'type' => 'theme_mod', // or 'option'
	// 	'capability' => 'edit_theme_options',
	// 	'theme_supports' => '', // Rarely needed.
	// 	'default' => 4,
	// 	'transport' => 'refresh', // or postMessage
	// 	'sanitize_callback' => '',
	// 	'sanitize_js_callback' => '', // Basically to_json.
	// ));

	// $wp_customize->add_control('slider_posts_per_page', array(
	// 	'type' => 'number',
	// 	'priority' => 20, // Within the section.
	// 	'section' => 'believe_slider', // Required, core or custom.
	// 	'label' => __('No. of posts'),
	// 	'description' => __('Max no. of posts to be displayed on the slider'),
	// 	'input_attr' => array(
	// 		'type' => 'number',
	// 	),
	// ));


	//Post ids
	$wp_customize->add_setting('slider_post_ids', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
		'default' => 'post',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'believe_sanitize_post_ids',
		'sanitize_js_callback' => '', // Basically to_json.
	));

	$wp_customize->add_control(new Believe_Customize_PostID_Control($wp_customize, 'slider_post_ids', array(
		'priority' => 10, // Within the section.
		'section' => 'believe_slider', // Required, core or custom.
		'label' => __('Post Ids'),
		'description' => __('Id of Posts to be displayed on the slider. seprate by comma ","'),
	)));

	$wp_customize->add_section('believe_slider', array(
		'title' => __('Slider', 'believe'),
		'description' => __('Believe theme silder settings', 'believe'),
		// 'panel' => 'believe_theme_options', // Not typically needed.
		'priority' => 109,
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	));
}

function believe_sanitize_post_ids($post_ids)
{
	$post_ids = explode(',', $post_ids);
	$post_ids = array_map(function ($id) {
		return (int) $id;
	}, $post_ids);
	return $post_ids;
}

require_once ABSPATH . WPINC . '/class-wp-customize-control.php';

class Believe_Customize_PostID_Control extends WP_Customize_Control
{
	public function render_content()
	{
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = (!empty($this->description)) ? ' aria-describedby="' . esc_attr($description_id) . '" ' : '';
?>
		<?php if (!empty($this->label)) : ?>
			<label for="<?php echo esc_attr($input_id); ?>" class="customize-control-title"><?php echo esc_html($this->label); ?></label>
		<?php endif; ?>
		<?php if (!empty($this->description)) : ?>
			<span id="<?php echo esc_attr($description_id); ?>" class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
		<input id="<?php echo esc_attr($input_id); ?>" type="<?php echo esc_attr($this->type); ?>" <?php echo $describedby_attr; ?> <?php $this->input_attrs(); ?> <?php if (!isset($this->input_attrs['value'])) : ?> value="<?php echo esc_attr(implode(',', $this->value())); ?>" <?php endif; ?> <?php $this->link(); ?> />
<?php
	}
}
/**
 * add footer settings and controls
 *
 * @return void
 */
function believe_customize_footer_section($wp_customize)
{

	$wp_customize->add_setting('copyright_text', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
		'default' => 'rtPanel 2011. All Right Reserved. Designed by rtCamp',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => '',
		'sanitize_js_callback' => '', // Basically to_json.
	));

	$wp_customize->add_control('copyright_text', array(
		'type' => 'textarea',
		'priority' => 10, // Within the section.
		'section' => 'footer', // Required, core or custom.
		'label' => __('Copyright Information'),
		'description' => __('Copyright Information for tor website.'),
		'input_attrs' => array(
			'class' => '',
			'style' => '',
			'placeholder' => __('Enter copyright information'),
		),
		// 'active_callback' => 'is_front_page',
	));

	$wp_customize->add_setting('footer_logo', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => '',
		'sanitize_js_callback' => '', // Basically to_json.
	));

	$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'footer_logo', array(
		'label' => __('Footer Logo', 'believe'),
		'section' => 'footer',
		'mime_type' => 'image',
	)));


	$wp_customize->add_section('footer', array(
		'title' => __('Footer', 'believe'),
		'description' => __('Believe Theme Footer Settings', 'believe'),
		// 'panel' => 'believe_theme_options', // Not typically needed.
		'priority' => 60,
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	));
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function believe_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function believe_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function believe_customize_preview_js()
{
	wp_enqueue_script('believe-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'believe_customize_preview_js');
