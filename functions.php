<?php
/*
 * Commented Include Twig Extension Component
 *
 * Copyright (C) Boris Đemrovski <djboris88@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Djboris88\Timber;

use Djboris88\Twig\Extension\CommentedIncludeExtension;

/**
 * @param $twig \Twig_Environment;
 *
 * @return \Twig_Environment
 */
function add_commented_include_extension($twig)
{
	$twig->addExtension(new CommentedIncludeExtension());

	return $twig;
}

/**
 * Tries to initialize the twig extension, if it has not been already.
 */
function initialize_filters()
{
	if (
		!defined('WP_DJBORIS88_TIMBER_FILTERS_INITIALIZED')
		&& defined('WP_DEBUG')
		&& WP_DEBUG
		&& function_exists('add_filter')
	) {
		define('WP_DJBORIS88_TIMBER_FILTERS_INITIALIZED', TRUE);

		add_filter('timber/loader/twig', sprintf('%s\\add_commented_include_extension', __NAMESPACE__));

		/**
		 * Adding a second filter to cover the `Timber::render()` case, when the
		 * template is not loaded through the `include` tag inside a twig file
		 */
		add_filter( 'timber/output', function( $output, $data, $file ) {
			return "\n<!-- Begin output of '" . $file . "' -->\n" . $output . "\n<!-- / End output of '" . $file . "' -->\n";
		}, 10, 3 );
	}
}

initialize_filters();
