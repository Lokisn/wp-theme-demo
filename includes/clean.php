<?php

/**
 * Remove emoji support
 *
 * @link https://wordpress.org/support/article/using-smilies/
 */

add_action(
	'init',
	function () {
		// Front-end
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		// Admin
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );

		// Feeds
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// Embeds
		remove_filter( 'embed_head', 'print_emoji_detection_script' );

		// Emails
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

		// Disable from TinyMCE editor. Disabled in block editor by default
		add_filter(
			'tiny_mce_plugins',
			function ( $plugins ) {
				if ( is_array( $plugins ) ) {
					$plugins = array_diff( $plugins, array( 'wpemoji' ) );
				}

				return $plugins;
			}
		);

		/**
		 * Finally, disable it from the database also, to prevent characters from converting
		 *  There used to be a setting under Writings to do this
		 *  Not ideal to get & update it here - but it works :/
		 */
		if ( (int) get_option( 'use_smilies' ) === 1 ) {
			update_option( 'use_smilies', 0 );
		}
	}
);

/**
 * Remove feeds and wordpress-specific content that is generated on the wp_head hook.
 *
 * @link https://developer.wordpress.org/reference/hooks/wp_head/
 */
add_action(
	'init',
	function () {
		// Remove the Really Simple Discovery service link
		remove_action( 'wp_head', 'rsd_link' );

		// Remove the link to the Windows Live Writer manifest
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Remove the general feeds
		remove_action( 'wp_head', 'feed_links', 2 );

		// Remove the extra feeds, such as category feeds
		remove_action( 'wp_head', 'feed_links_extra', 3 );

		// Remove the displayed XHTML generator
		remove_action( 'wp_head', 'wp_generator' );

		// Remove the REST API link tag
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

		// Remove oEmbed discovery links.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

		// Remove rel next/prev links
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

		// Remove prefetch url
		remove_action( 'wp_head', 'wp_resource_hints', 2 );
	}
);

/**
 * De-registers WordPress default javascript
 *
 * @link https://developer.wordpress.org/reference/functions/wp_deregister_script/
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_deregister_script( 'jquery' );
	}
);

/**
 * Remove oEmbed-specific JavaScript from the front-end and back-end.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_oembed_add_host_js/
 */
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

/**
 * Disable the REST API
 */
add_action(
	'init',
	function () {
		add_filter( 'rest_jsonp_enabled', '__return_false' );

		remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'template_redirect', 'rest_output_link_header', 11 );
	}
);

/**
 * Hide admin menu items. Can be both parents and children in dropdowns.
 * Specify link to parent and link to child.
 *
 * @link https://developer.wordpress.org/reference/functions/remove_menu_page/
 */
add_action(
	'admin_menu',
	function () {

        // si admin, rien n'est cacher 
        if(current_user_can('administrator')){
            return;
        }

		// Remove Dashboard
		remove_menu_page( 'index.php' );
		// Remove Dashboard -> Update Core notice
		remove_submenu_page( 'index.php', 'update-core.php' );

		// Remove Comments
		remove_menu_page( 'edit-comments.php' );

		// Remove Appearance
		remove_menu_page( 'themes.php' );
		// Remove Appearance -> Themes
		remove_submenu_page( 'themes.php', 'themes.php' );
		// Remove Appearance -> Customize
		remove_submenu_page( 'themes.php', 'customize.php?return=' . urlencode( $_SERVER['REQUEST_URI'] ) );

		// Remove Plugins
		remove_menu_page( 'plugins.php' );
		// Remove Plugins -> Installed plugins
		remove_submenu_page( 'plugins.php', 'plugins.php' );
		// Remove Plugins -> Add new plugins
		remove_submenu_page( 'plugins.php', 'plugin-install.php' );
		// Remove Plugins -> Plugin editor
		remove_submenu_page( 'plugins.php', 'plugin-editor.php' );

		// Remove Tools
		remove_menu_page( 'tools.php' );
		// Remove Tools -> Available Tools
		remove_submenu_page( 'tools.php', 'tools.php' );
		// Remove Tools -> Import
		remove_submenu_page( 'tools.php', 'import.php' );
		// Remove Tools -> Export
		remove_submenu_page( 'tools.php', 'export.php' );

		// Remove Settings
		remove_menu_page( 'options-general.php' );
		// Remove Settings -> Writing
		remove_submenu_page( 'options-general.php', 'options-writing.php' );
		// Remove Settings -> Reading
		remove_submenu_page( 'options-general.php', 'options-reading.php' );
		// Remove Settings -> Discussion
		remove_submenu_page( 'options-general.php', 'options-discussion.php' );
		// Remove Settings -> Media
		remove_submenu_page( 'options-general.php', 'options-media.php' );
		// Remove Settings -> Permalinks
		remove_submenu_page( 'options-general.php', 'options-permalink.php' );
	},
	999
);

/**
 * Removing dashboard widgets.
 *
 * @link https://developer.wordpress.org/reference/functions/remove_meta_box/
 */
add_action(
	'wp_dashboard_setup',
	function () {

         // si admin, rien n'est cacher 
         if(current_user_can('administrator')){
            return;
        }

		// Remove the 'Welcome' panel
		remove_action( 'welcome_panel', 'wp_welcome_panel' );

		// Remove 'Site health' metabox
		remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );

		// Remove the 'At a Glance' metabox
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );

		// Remove the 'Activity' metabox
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );

		// Remove the 'WordPress News' metabox
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );

		// Remove the 'Quick Draft' metabox
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	}
);

/**
 * Remove access to the dashboard
*/
add_action(
	'admin_init',
	function () {
         // si admin, rien n'est cacher 
         if(current_user_can('administrator')){
            return;
        }
		global $pagenow; // Get current page
		$redirect = get_admin_url( null, 'edit.php' ); // Where to redirect

		if ( $pagenow == 'index.php' ) {
			wp_redirect( $redirect, 301 );
			exit;
		}
	}
);