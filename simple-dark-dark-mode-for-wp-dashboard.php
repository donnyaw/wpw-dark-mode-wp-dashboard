<?php
/**
 * Plugin Name: WP Dashboard Dark Mode
 * Plugin URI: https://github.com/donnyaw/dark-mode-wp-dashboard
 * Description: Adds dark mode styling to the WordPress dashboard with a toggle in the top-right admin bar.
 * Author: donnyaw
 * Author URI: https://github.com/donnyaw
 * Text Domain: wp-dashboard-dark-mode
 * Version: 1.1.1
 *
 * @package wp-dashboard-dark-mode
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

define( 'WP_DASHBOARD_DARK_MODE_VERSION', '1.1.1' );
define( 'WP_DASHBOARD_DARK_MODE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_DASHBOARD_DARK_MODE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_DASHBOARD_DARK_MODE_PLUGIN_FILE', 'dark-mode-wp-dashboard/simple-dark-dark-mode-for-wp-dashboard.php' );
define( 'WP_DASHBOARD_DARK_MODE_STORAGE_KEY', 'wp-dashboard-dark-mode-enabled' );

add_action( 'admin_enqueue_scripts', 'wp_dashboard_dark_mode_enqueue_assets', 99999 );
function wp_dashboard_dark_mode_enqueue_assets() {
	wp_dequeue_style( 'activitypub-admin' );

	wp_enqueue_style(
		'wp-dashboard-dark-mode',
		WP_DASHBOARD_DARK_MODE_PLUGIN_URL . 'assets/css/prod/dark-mode.css',
		array(),
		filemtime( WP_DASHBOARD_DARK_MODE_PLUGIN_DIR . 'assets/css/prod/dark-mode.css' )
	);

	wp_register_style( 'wp-dashboard-dark-mode-toggle', false, array(), WP_DASHBOARD_DARK_MODE_VERSION );
	wp_enqueue_style( 'wp-dashboard-dark-mode-toggle' );
	wp_add_inline_style(
		'wp-dashboard-dark-mode-toggle',
		'#wpadminbar, #wpadminbar .quicklinks>ul>li, #wpadminbar .ab-top-menu>li:hover>.ab-item, #wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar .ab-top-menu>li>.ab-item:focus, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus, #wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input { background: #1d2327 !important; }' .
		'#wpadminbar .ab-item, #wpadminbar a.ab-item, #wpadminbar>#wp-toolbar span.ab-label, #wpadminbar>#wp-toolbar span.noticon, #wpadminbar .quicklinks .menupop ul li a, #wpadminbar .quicklinks .menupop.hover ul li a, #wpadminbar .quicklinks .menupop ul li a:hover, #wpadminbar .quicklinks .menupop ul li a:focus, #wpadminbar .quicklinks .menupop .ab-sub-wrapper, #wpadminbar .ab-icon, #wpadminbar .ab-top-menu>li:hover>.ab-item:before, #wpadminbar .ab-top-menu>li>.ab-item:focus:before { color: #f0f0f1 !important; }' .
		'#wp-admin-bar-wp-dashboard-dark-mode-toggle .ab-item { padding: 0 8px; }' .
		'.wp-dashboard-dark-mode-editor-slot { display: inline-flex; align-items: center; margin-left: 8px; }' .
		'.edit-post-header-toolbar .wp-dashboard-dark-mode-toggle, .editor-header .wp-dashboard-dark-mode-toggle { width: 36px; height: 36px; color: #1e1e1e; }' .
		'#adminmenuback, #adminmenuwrap, #adminmenu, #adminmenu .wp-submenu, #adminmenu .wp-has-current-submenu .wp-submenu, #adminmenu .wp-has-current-submenu.opensub .wp-submenu { background: #1d2327 !important; }' .
		'#adminmenu a, #adminmenu .wp-submenu a, #adminmenu div.wp-menu-image:before, #adminmenu .wp-menu-name { color: #f0f0f1 !important; }' .
		'#adminmenu li.menu-top:hover, #adminmenu li.opensub > a.menu-top, #adminmenu li > a.menu-top:focus, #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.current.menu-top { background: #2c3338 !important; color: #f0f0f1 !important; }' .
		'#adminmenu li.menu-top:hover div.wp-menu-image:before, #adminmenu li.opensub > a.menu-top div.wp-menu-image:before, #adminmenu li > a.menu-top:focus div.wp-menu-image:before, #adminmenu li.wp-has-current-submenu div.wp-menu-image:before, #adminmenu li.current div.wp-menu-image:before { color: #72aee6 !important; }' .
		'#adminmenu .wp-submenu a:hover, #adminmenu .wp-submenu a:focus, #adminmenu .wp-has-current-submenu .wp-submenu a:hover, #adminmenu .wp-has-current-submenu .wp-submenu a:focus, #adminmenu .wp-submenu li.current a { color: #72aee6 !important; }' .
		'.wp-dashboard-dark-mode-toggle { position: relative; display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border: 1px solid transparent; border-radius: 999px; background: transparent; color: inherit; cursor: pointer; transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, transform 0.2s ease; }' .
		'.wp-dashboard-dark-mode-toggle:hover, .wp-dashboard-dark-mode-toggle:focus-visible, .wp-dashboard-dark-mode-toggle.is-active { background: rgba(148, 163, 184, 0.14); border-color: rgba(148, 163, 184, 0.28); outline: none; }' .
		'.wp-dashboard-dark-mode-toggle:hover, .wp-dashboard-dark-mode-toggle:focus-visible { transform: translateY(-1px); }' .
		'.wp-dashboard-dark-mode-icon { position: absolute; display: inline-flex; align-items: center; justify-content: center; transition: opacity 0.2s ease, transform 0.2s ease; }' .
		'.wp-dashboard-dark-mode-icon-moon { opacity: 0; transform: scale(0.72); }' .
		'.wp-dashboard-dark-mode-toggle.is-active .wp-dashboard-dark-mode-icon-sun { opacity: 0; transform: scale(0.72); }' .
		'.wp-dashboard-dark-mode-toggle.is-active .wp-dashboard-dark-mode-icon-moon { opacity: 1; transform: scale(1); }'
	);

	wp_register_script( 'wp-dashboard-dark-mode-toggle', false, array(), WP_DASHBOARD_DARK_MODE_VERSION, true );
	wp_enqueue_script( 'wp-dashboard-dark-mode-toggle' );
	wp_add_inline_script(
		'wp-dashboard-dark-mode-toggle',
		"(function(){var storageKey='" . esc_js( WP_DASHBOARD_DARK_MODE_STORAGE_KEY ) . "';var styleId='wp-dashboard-dark-mode-css';var editorButtonClass='wp-dashboard-dark-mode-toggle-editor';function getSavedState(){try{var saved=window.localStorage.getItem(storageKey);if(saved==='true'){return true;}if(saved==='false'){return false;}}catch(e){}return true;}function saveState(enabled){try{window.localStorage.setItem(storageKey,enabled?'true':'false');}catch(e){}}function getStyle(){return document.getElementById(styleId);}function getButtons(){return document.querySelectorAll('.wp-dashboard-dark-mode-toggle');}function buttonMarkup(){return '<button type=\"button\" class=\"wp-dashboard-dark-mode-toggle '+editorButtonClass+'\" aria-label=\"Toggle dashboard dark mode\" aria-pressed=\"true\"><span class=\"wp-dashboard-dark-mode-icon wp-dashboard-dark-mode-icon-sun\" aria-hidden=\"true\"><svg viewBox=\"0 0 24 24\" width=\"18\" height=\"18\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"4.5\"></circle><path d=\"M12 2.5v2.2M12 19.3v2.2M4.93 4.93l1.56 1.56M17.51 17.51l1.56 1.56M2.5 12h2.2M19.3 12h2.2M4.93 19.07l1.56-1.56M17.51 6.49l1.56-1.56\"></path></svg></span><span class=\"wp-dashboard-dark-mode-icon wp-dashboard-dark-mode-icon-moon\" aria-hidden=\"true\"><svg viewBox=\"0 0 24 24\" width=\"18\" height=\"18\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M20.2 14.2A8.5 8.5 0 0 1 9.8 3.8a8.8 8.8 0 1 0 10.4 10.4Z\"></path></svg></span><span class=\"screen-reader-text\">Toggle dashboard dark mode</span></button>';}function ensureEditorButton(){var toolbar=document.querySelector('.edit-post-header__settings, .editor-header__settings');if(!toolbar||toolbar.querySelector('.'+editorButtonClass)){return;}var slot=document.createElement('div');slot.className='wp-dashboard-dark-mode-editor-slot';slot.innerHTML=buttonMarkup();toolbar.insertBefore(slot,toolbar.firstChild);}function setEnabled(enabled){var style=getStyle();if(style){style.disabled=!enabled;}getButtons().forEach(function(button){button.setAttribute('aria-pressed',enabled?'true':'false');button.setAttribute('aria-label',enabled?'Disable dashboard dark mode':'Enable dashboard dark mode');button.setAttribute('title',enabled?'Disable dashboard dark mode':'Enable dashboard dark mode');button.classList.toggle('is-active',enabled);});document.documentElement.classList.toggle('wp-dashboard-dark-mode-off',!enabled);saveState(enabled);}function toggle(event){event.preventDefault();setEnabled(!getSavedState());}function bindButtons(){getButtons().forEach(function(button){if(button.dataset.darkModeBound==='true'){return;}button.dataset.darkModeBound='true';button.addEventListener('click',toggle);});}function init(){ensureEditorButton();bindButtons();setEnabled(getSavedState());window.setTimeout(function(){ensureEditorButton();bindButtons();setEnabled(getSavedState());},600);}if(document.readyState==='loading'){document.addEventListener('DOMContentLoaded',init);}else{init();}var observer=new MutationObserver(function(){ensureEditorButton();bindButtons();});observer.observe(document.documentElement,{childList:true,subtree:true});})();"
	);
}

add_action( 'admin_bar_menu', 'wp_dashboard_dark_mode_add_admin_bar_toggle', 999 );
function wp_dashboard_dark_mode_add_admin_bar_toggle( $wp_admin_bar ) {
	if ( ! is_admin() || ! is_admin_bar_showing() ) {
		return;
	}

	$wp_admin_bar->add_node(
		array(
			'id'     => 'wp-dashboard-dark-mode-toggle',
			'parent' => 'top-secondary',
			'title'  => '<button type="button" class="wp-dashboard-dark-mode-toggle" aria-label="Toggle dashboard dark mode" aria-pressed="true"><span class="wp-dashboard-dark-mode-icon wp-dashboard-dark-mode-icon-sun" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4.5"></circle><path d="M12 2.5v2.2M12 19.3v2.2M4.93 4.93l1.56 1.56M17.51 17.51l1.56 1.56M2.5 12h2.2M19.3 12h2.2M4.93 19.07l1.56-1.56M17.51 6.49l1.56-1.56"></path></svg></span><span class="wp-dashboard-dark-mode-icon wp-dashboard-dark-mode-icon-moon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.2 14.2A8.5 8.5 0 0 1 9.8 3.8a8.8 8.8 0 1 0 10.4 10.4Z"></path></svg></span><span class="screen-reader-text">Toggle dashboard dark mode</span></button>',
			'href'   => '#',
			'meta'   => array(
				'class' => 'wp-dashboard-dark-mode-menu-item',
				'title' => __( 'Toggle dashboard dark mode', 'wp-dashboard-dark-mode' ),
			),
		)
	);
}

add_filter( 'plugins_api', 'wp_dashboard_dark_mode_plugin_view_version_details', 9999, 3 );
function wp_dashboard_dark_mode_plugin_view_version_details( $res, $action, $args ) {
	if ( 'plugin_information' !== $action || empty( $args->slug ) || 'dark-mode-wp-dashboard' !== $args->slug ) {
		return $res;
	}

	$release = wp_dashboard_dark_mode_get_latest_release();

	$res              = new stdClass();
	$res->name        = 'WP Dashboard Dark Mode';
	$res->slug        = 'dark-mode-wp-dashboard';
	$res->path        = WP_DASHBOARD_DARK_MODE_PLUGIN_FILE;
	$res->version     = ! empty( $release['tag_name'] ) ? ltrim( $release['tag_name'], 'v' ) : WP_DASHBOARD_DARK_MODE_VERSION;
	$res->homepage    = 'https://github.com/donnyaw/dark-mode-wp-dashboard';
	$res->download_link = ! empty( $release['assets'][0]['browser_download_url'] ) ? $release['assets'][0]['browser_download_url'] : '';
	$res->sections    = array(
		'description' => 'Adds dark mode styling to the WordPress dashboard with a toggle in the top-right admin bar.',
	);

	return $res;
}

add_filter( 'update_plugins_github.com', 'wp_dashboard_dark_mode_self_update', 10, 4 );

/**
 * Checks for updates to this plugin.
 *
 * @param array  $update      Array of update data.
 * @param array  $plugin_data Array of plugin data.
 * @param string $plugin_file Path to plugin file.
 * @param mixed  $locales     Locale data.
 *
 * @return array|bool
 */
function wp_dashboard_dark_mode_self_update( $update, array $plugin_data, string $plugin_file, $locales ) {
	if ( WP_DASHBOARD_DARK_MODE_PLUGIN_FILE !== $plugin_file ) {
		return $update;
	}

	if ( ! empty( $update ) ) {
		return $update;
	}

	$release = wp_dashboard_dark_mode_get_latest_release();

	if ( empty( $release['tag_name'] ) ) {
		return false;
	}

	$new_version_number  = ltrim( $release['tag_name'], 'v' );
	$is_update_available = version_compare( $plugin_data['Version'], $new_version_number, '<' );

	if ( ! $is_update_available ) {
		return false;
	}

	return array(
		'slug'    => 'dark-mode-wp-dashboard',
		'version' => $new_version_number,
		'url'     => ! empty( $release['html_url'] ) ? $release['html_url'] : 'https://github.com/donnyaw/dark-mode-wp-dashboard',
		'package' => ! empty( $release['assets'][0]['browser_download_url'] ) ? $release['assets'][0]['browser_download_url'] : '',
	);
}

/**
 * Gets the latest GitHub release for this plugin.
 *
 * @return array
 */
function wp_dashboard_dark_mode_get_latest_release() {
	$response = wp_remote_get(
		'https://api.github.com/repos/donnyaw/dark-mode-wp-dashboard/releases/latest',
		array(
			'user-agent' => 'donnyaw',
		)
	);

	if ( is_wp_error( $response ) ) {
		return array();
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );

	return is_array( $body ) ? $body : array();
}
