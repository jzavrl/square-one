<?php

/**
 * Preprocesses the wrapping HTML.
 *
 * @param array &$variables
 *   Template variables.
 */
function square-one_preprocess_html(&$vars) {
	// Setup IE meta tag to force IE rendering mode
	$meta_ie_render_engine = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
			'content' =>  'IE=edge,chrome=1',
			'http-equiv' => 'X-UA-Compatible',
		)
	);

	// Mobile viewport optimized: h5bp.com/viewport
	$meta_viewport = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
			'content' =>  'width=device-width',
			'name' => 'viewport',
		)
	);

	// Add header meta tag for IE to head
	drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');
	drupal_add_html_head($meta_viewport, 'meta_viewport');
}

function square-one_css_alter(&$css) {
	unset($css[drupal_get_path('module','system') . '/system.menus.css']);
	unset($css[drupal_get_path('module','system') . '/system.messages.css']);
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function square-one_breadcrumb($variables) {
	// Determine if we are to display the breadcrumb.
	$breadcrumb = $variables['breadcrumb'];

	// Return the breadcrumb with separators.
	if (!empty($breadcrumb)) {
		$breadcrumb_separator = '<span class="seperator"> - </span>';

		$item = menu_get_item();
		if (!empty($item['tab_parent'])) {
			// If we are on a non-default tab, use the tab's title.
			$title = check_plain($item['title']);
		} else {
			$title = drupal_get_title();
		}

		return '<nav class="breadcrumbs">' . implode($breadcrumb_separator, $breadcrumb) . $breadcrumb_separator . '<span class="title">' . $title . '</span></nav>';
	}

	// Otherwise, return an empty string.
	return '';
}

/**
 * Generate the HTML output for a menu link and submenu.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: Structured array data for a menu link.
 *
 * @return
 *   A themed HTML string.
 *
 * @ingroup themeable
 */
function square-one_menu_link(array $variables) {
	$element = $variables['element'];
	$sub_menu = '';

	if ($element['#below']) {
		$sub_menu = drupal_render($element['#below']);
	}

	$output = l($element['#title'], $element['#href'], $element['#localized_options']);
	// Adding a class depending on the TITLE of the link (not constant)
	$element['#attributes']['class'][] = drupal_html_class($element['#title']);
	// Adding a class depending on the ID of the link (constant)
	if (isset($element['#original_link']['mlid']) && !empty($element['#original_link']['mlid'])) {
		$element['#attributes']['class'][] = 'mid-' . $element['#original_link']['mlid'];
		$element['#attributes']['class'][] .= 'level-' . $element['#original_link']['depth'];
	}

	return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}