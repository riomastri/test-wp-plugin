/*
* Plugin Name: Test WP Plugin
* Plugin URI: https://riomastri.com;
* Description: Cuma coba-coba make Self Hoster
* Version: 1.0.0
* Author: Rio Mastri
* Author URI: https://riomastri.com
* Text Domain: Rio Mastri
*/

/**
* Allow SVG File Uploads.
*
* @param array $mimes An associative array of allowed file types.
*
* @return array Modified array of allowed file types.
*/
function gltd__enable_svg_uploads( array $mimes ): array {
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}

add_filter( 'upload_mimes', 'gltd__enable_svg_uploads' );

/**
* Allow WebP File Uploads.
*
* @param array $mimes An associative array of allowed file types.
*
* @return array Modified array of allowed file types.
*/
function gltd__enable_webp_uploads( array $mimes ): array {
$mimes['webp'] = 'image/webp';
return $mimes;
}

add_filter( 'upload_mimes', 'gltd__enable_webp_uploads' );

/**
* Redirect Attachments To Their Parent Post/Page.
*
* @param string $url The attachment URL.
*
* @return string The modified URL (if applicable).
*/
function gltd_redirect_attachments( string $url ): string {
if ( is_attachment() ) {
$parent = get_post( $post->post_parent );
if ( $parent ) {
$parent_link = get_permalink( $parent->ID );
if ( $parent_link ) {
return $parent_link;
}
}
}
return $url;
}
add_filter( 'wp_get_attachment_url', 'gltd_redirect_attachments' );


/**
* Speed Up the Block Editor.
*/
add_filter( 'should_load_separate_core_block_assets', '__return_true' );

/**
* Disable XML-RPC.
*/
add_filter( 'xmlrpc_enabled', '__return_false' );


/**
* Hide Login Errors To Improve Security.
*
* @return string Custom error message.
*/
function gltd_hide_login_errors(): string {
return '<strong>ERROR</strong>: Incorrect Credentials!';
}
add_filter( 'login_errors', 'gltd_hide_login_errors' );


/**
* Remove WordPress Version Generator Tag.
*/
remove_action( 'wp_head', 'wp_generator' );


/**
* Remove WooCommerce Version Generator Tag.
*/
remove_action( 'wp_head', 'wc_generator' );


/**
* Remove X-Powered-By header.
*
* @return void
*/
function gltd_remove_x_powered_by() : void {
if (function_exists('header_remove')) {
header_remove('x-powered-by');
}
}
add_action( 'wp', 'gltd_remove_x_powered_by' );



/**
* Change Default "From" Name To 'Rio Mastri'
*
* @return string
*/
function gltd_change_default_from_name(): string {
return 'Rio Mastri';
}
add_filter( 'wp_mail_from_name', 'gltd_change_default_from_name' );



/**
* Change Default "From" Email To 'hello@riomastri.com'
*
* @return string
*/
function gltd_change_default_from_email(): string {
return 'hello@riomastri.com';
}
add_filter( 'wp_mail_from', 'gltd_change_default_from_email' );