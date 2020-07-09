<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array (
		'key' => 'group_563480f6140f6',
		'title' => esc_html__('Appearance', 'jo-theme'),
		'fields' => array (
			array (
				'key' => 'field_571b9716efde6',
				'label' => esc_html__('Header', 'jo-theme'),
				'name' => 'header',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_5634810126d92',
				'label' => esc_html__('Header layout', 'jo-theme'),
				'name' => 'header_layout',
				'type' => 'select',
				'instructions' => wp_kses_post(__('Choose default header layout for only this page.', 'jo-theme')),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'inherit' => esc_html__('Inherit from global options', 'jo-theme'),
					'header_1' => esc_html__('Header style 1', 'jo-theme'),
					'header_2' => esc_html__('Header style 2', 'jo-theme'),
					'header_3' => esc_html__('Header style 3', 'jo-theme'),
					'header_4' => esc_html__('Header style 4', 'jo-theme'),
					'header_5' => esc_html__('Header style 5', 'jo-theme'),
				),
				'default_value' => array (
					0 => 'inherit',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_56d0332716932',
				'label' => esc_html__('Header text color', 'jo-theme'),
				'name' => 'header_color',
				'type' => 'color_picker',
				'instructions' => wp_kses_post(__('Leave empty to use global default.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
			),
			array (
				'key' => 'field_56e8540f808c2',
				'label' => esc_html__('Header background color', 'jo-theme'),
				'name' => 'header_background_color',
				'type' => 'rgba_color',
				'instructions' => wp_kses_post(__('Can be empty.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'rgba' => '',
				'return_value' => 0,
				'ext_value' => array (
				),
			),
			array (
				'key' => 'field_577febc3fa959',
				'label' => esc_html__('Footer', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_577febcdfa95a',
				'label' => esc_html__('Appendix', 'jo-theme'),
				'name' => 'footer_appendix',
				'type' => 'select',
				'instructions' => wp_kses_post(__('Select which helper should be displayed on the right side of the footer.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'inherit' => esc_html__('Inherit from global options', 'jo-theme'),
					'gotop' => esc_html__('"Go to top" button', 'jo-theme'),
					'complex' => esc_html__('Complex (social icons, search and "go to top" button)', 'jo-theme'),
				),
				'default_value' => array (
					0 => 'inherit',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_577ff202fed8a',
				'label' => esc_html__('Page hero', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_577ff212fed8b',
				'label' => esc_html__('Disable hero', 'jo-theme'),
				'name' => 'disable_hero',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'check to disable',
				'default_value' => 0,
			),
			array (
				'key' => 'field_577ff22afed8c',
				'label' => esc_html__('Hero text', 'jo-theme'),
				'name' => 'hero_text',
				'type' => 'text',
				'instructions' => wp_kses_post(__('Leave empty to use default page/post title.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_577ff23dfed8d',
				'label' => esc_html__('Hero subline', 'jo-theme'),
				'name' => 'hero_subline',
				'type' => 'text',
				'instructions' => wp_kses_post(__('Can be empty, will be shown under primary text.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_577ff320cf57f',
				'label' => esc_html__('Blog hero', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_577ff332cf580',
				'label' => esc_html__('Custom hero block', 'jo-theme'),
				'name' => 'use_post_hero_block',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'check to enable',
				'default_value' => 0,
			),
			array (
				'key' => 'field_577ff34ecf581',
				'label' => esc_html__('Hero markup', 'jo-theme'),
				'name' => 'hero_markup',
				'type' => 'textarea',
				'instructions' => wp_kses_post(__('HTML and shortcodes are supported. This code will be applied before post title instead of featured image.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_577ff332cf580',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'jo-portfolio',
				),
			),
		),
		'menu_order' => -100,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array (
		'key' => 'group_55fe577f0de0e',
		'title' => esc_html__('Testimonials custom fields', 'jo-theme'),
		'fields' => array (
			array (
				'key' => 'field_55fe578a48e00',
				'label' => esc_html__('Author photo', 'jo-theme'),
				'name' => 'author_photo',
				'type' => 'image',
				'instructions' => wp_kses_post(__('Standard placeholder will be used if not specified.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'testimonials_thumb',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array (
				'key' => 'field_55fe57cd48e01',
				'label' => esc_html__('Author name', 'jo-theme'),
				'name' => 'author_name',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'John Doe',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_55fe57f548e02',
				'label' => esc_html__('Author info', 'jo-theme'),
				'name' => 'author_info',
				'type' => 'textarea',
				'instructions' => wp_kses_post(__('Can be empty.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 3,
				'new_lines' => 'br',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'jo-testimonials',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'left',
		'instruction_placement' => 'field',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array (
		'key' => 'group_55df002abfdba',
		'title' => esc_html__('Theme General Settings', 'jo-theme'),
		'fields' => array (
			array (
				'key' => 'field_55df0137db015',
				'label' => esc_html__('General', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_55df2d89693b6',
				'label' => esc_html__('Use Image as a logo?', 'jo-theme'),
				'name' => 'image_as_logo',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_55df2daf693b7',
				'label' => esc_html__('Logo text', 'jo-theme'),
				'name' => 'logo_text',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_55df2d89693b6',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'JO Theme',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_55df2de2693b8',
				'label' => esc_html__('Logo image', 'jo-theme'),
				'name' => 'logo_image',
				'type' => 'image',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_55df2d89693b6',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'full',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array (
				'key' => 'field_576a6f27db4e8',
				'label' => esc_html__('Phone number', 'jo-theme'),
				'name' => 'phone_number',
				'type' => 'text',
				'instructions' => wp_kses_post(__('Will be shown in header if selected header layout provides such ability. You can leave field empty.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '+1-202-555-0132',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_55fad44494054',
				'label' => esc_html__('Disable animations', 'jo-theme'),
				'name' => 'disable_animations',
				'type' => 'true_false',
				'instructions' => wp_kses_post(__('This option will disable any reveal animations on the site.<br/>May highly increase performance on slow computers.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_55df2e5623380',
				'label' => esc_html__('Footer text', 'jo-theme'),
				'name' => 'footer_text',
				'type' => 'textarea',
				'instructions' => wp_kses_post(__('Will be displayed on the left side of bottom text line in footer. HTML is allowed.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Copyright &copy; 2016. Design by <a href="http://wphunters.com/">WPHunters</a>',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 5,
				'new_lines' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_55df2f03057f4',
				'label' => esc_html__('Custom JS/CSS', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_55df2f15057f5',
				'label' => esc_html__('Custom CSS', 'jo-theme'),
				'name' => 'custom_css',
				'type' => 'textarea',
				'instructions' => wp_kses_post(__('Will be applied after main styles in head section of site. Here you can overwrite all default styles.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_55df2f51057f6',
				'label' => esc_html__('Custom JS', 'jo-theme'),
				'name' => 'custom_js',
				'type' => 'textarea',
				'instructions' => wp_kses_post(__('Will be applied in footer after all theme scripts.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_55df2f8a15aa7',
				'label' => esc_html__('NOTE!', 'jo-theme'),
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'If you are going to use jQuery in this field - please keep in mind that WordPress by default uses a conflict-free version of jQuery. So, instead of <code>$</code> you need to use <code>jQuery</code> variable.',
				'esc_html' => 0,
				'new_lines' => 'wpautop',
			),
			array (
				'key' => 'field_55df304f9cdc4',
				'label' => esc_html__('Social Networks', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_55df30939bd4f',
				'label' => esc_html__('Social Networks', 'jo-theme'),
				'name' => 'social_networks',
				'type' => 'repeater',
				'instructions' => wp_kses_post(__('Here you can define your social network profiles. They will be shown in site header.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'min' => '',
				'max' => '',
				'layout' => 'table',
				'button_label' => 'Add network',
				'collapsed' => '',
				'sub_fields' => array (
					array (
						'key' => 'field_55df30db9bd50',
						'label' => esc_html__('Profile URL', 'jo-theme'),
						'name' => 'profile_url',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '#',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_55df310c9bd51',
						'label' => esc_html__('Profile Icon', 'jo-theme'),
						'name' => 'profile_icon',
						'type' => 'fonticonpicker',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
					),
				),
			),
			array (
				'key' => 'field_55fec360c4064',
				'label' => esc_html__('Layouts', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_563478b7be39e',
				'label' => esc_html__('Header layout', 'jo-theme'),
				'name' => 'header_layout',
				'type' => 'select',
				'instructions' => wp_kses_post(__('Choose default header layout. This option can be set for each page independently on page edit screen.', 'jo-theme')),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'header_1' => esc_html__('Header style 1', 'jo-theme'),
					'header_2' => esc_html__('Header style 2', 'jo-theme'),
					'header_3' => esc_html__('Header style 3', 'jo-theme'),
					'header_4' => esc_html__('Header style 4', 'jo-theme'),
					'header_5' => esc_html__('Header style 5', 'jo-theme'),
				),
				'default_value' => array (
					0 => 'header_1',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_577fec8e6d5f2',
				'label' => esc_html__('Footer appendix', 'jo-theme'),
				'name' => 'footer_appendix',
				'type' => 'select',
				'instructions' => wp_kses_post(__('Select which helper should be displayed on the right side of the footer.', 'jo-theme')),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'gotop' => esc_html__('"Go to top" button', 'jo-theme'),
					'complex' => esc_html__('Complex (social icons, search and "go to top" button)', 'jo-theme'),
				),
				'default_value' => array (
					0 => 'gotop',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'wph-theme-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array (
		'key' => 'group_55e026df5e422',
		'title' => esc_html__('Theme Styling', 'jo-theme'),
		'fields' => array (
			array (
				'key' => 'field_55e026ec56e4b',
				'label' => esc_html__('Fonts', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_55e026f956e4c',
				'label' => esc_html__('Primary font', 'jo-theme'),
				'name' => 'primary_font',
				'type' => 'google_font_selector',
				'instructions' => wp_kses_post(__('Used in logo, regular text paragraphs, descriptions & almost all other text blocks.', 'jo-theme')),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'include_web_safe_fonts' => 0,
				'enqueue_font' => 1,
				'default_font' => 'Crimson Text',
			),
			array (
				'key' => 'field_55e0274e56e4d',
				'label' => esc_html__('Secondary font', 'jo-theme'),
				'name' => 'secondary_font',
				'type' => 'google_font_selector',
				'instructions' => wp_kses_post(__('Used in secondary-level elements: headers, buttons and etc..', 'jo-theme')),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'include_web_safe_fonts' => 0,
				'enqueue_font' => 1,
				'default_font' => 'Roboto',
			),
			array (
				'key' => 'field_55e027a5acdac',
				'label' => esc_html__('Colors', 'jo-theme'),
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_55e027aeacdad',
				'label' => esc_html__('Primary color', 'jo-theme'),
				'name' => 'primary_color',
				'type' => 'color_picker',
				'instructions' => wp_kses_post(__('Used in buttons, links, menus and other primary-level control elements.', 'jo-theme')),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#67afd1',
			),
			array (
				'key' => 'field_56ce9fe0ea107',
				'label' => esc_html__('Secondary color', 'jo-theme'),
				'name' => 'secondary_color',
				'type' => 'color_picker',
				'instructions' => wp_kses_post(__('Used in section backgrounds, sidebar widget headers and other third-party elements.', 'jo-theme')),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#eeeeee',
			),
			array (
				'key' => 'field_55e0285a3c4ec',
				'label' => esc_html__('Site background', 'jo-theme'),
				'name' => 'site_background',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#ffffff',
			),
			array (
				'key' => 'field_56e854dfab8f6',
				'label' => esc_html__('Header', 'jo-theme'),
				'name' => 'header',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_56e854ecab8f7',
				'label' => esc_html__('Text color', 'jo-theme'),
				'name' => 'header_color',
				'type' => 'color_picker',
				'instructions' => wp_kses_post(__('Select default header color.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#000',
			),
			array (
				'key' => 'field_56e85525ab8f8',
				'label' => esc_html__('Background color', 'jo-theme'),
				'name' => 'header_background_color',
				'type' => 'rgba_color',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'rgba' => 'rgba(238,243,246,1)',
				'return_value' => 0,
				'ext_value' => array (
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'wph-theme-settings',
				),
			),
		),
		'menu_order' => 10,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array (
		'key' => 'group_57779ba205f79',
		'title' => esc_html__('CPT Options', 'jo-theme'),
		'fields' => array (
			array (
				'key' => 'field_57779bb2ed4d5',
				'label' => esc_html__('Blog', 'jo-theme'),
				'name' => 'blog',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_57779bbced4d6',
				'label' => esc_html__('Singular hero text', 'jo-theme'),
				'name' => 'blogroll_hero_text',
				'type' => 'text',
				'instructions' => wp_kses_post(__('Text to display on blog post pages.', 'jo-theme')),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Blog',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_577938899293b',
				'label' => esc_html__('Listing layout', 'jo-theme'),
				'name' => 'blogroll_page_layout',
				'type' => 'select',
				'instructions' => wp_kses_post(__('Select how posts will be displayed on blog pages. The same layout will be applied to archive and search pages.', 'jo-theme')),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'flat' => esc_html__('Regular flat list', 'jo-theme'),
					'chess' => esc_html__('Chess-like layout', 'jo-theme'),
					'grid' => esc_html__('4-column grid', 'jo-theme'),
				),
				'default_value' => array (
					0 => 'flat',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_577a43a483d6c',
				'label' => esc_html__('Grid layout', 'jo-theme'),
				'name' => 'blogroll_grid_layout',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_577938899293b',
							'operator' => '==',
							'value' => 'grid',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'layout_1' => esc_html__('Layout #1 (white box on hover)', 'jo-theme'),
					'layout_2' => esc_html__('Layout #2 (white line on the bottom)', 'jo-theme'),
					'layout_3' => esc_html__('Layout #3 (gradient on the bottom)', 'jo-theme'),
				),
				'default_value' => array (
					0 => 'layout_3',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'wph-theme-settings',
				),
			),
		),
		'menu_order' => 15,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;