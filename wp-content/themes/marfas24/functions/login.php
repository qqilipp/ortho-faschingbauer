<?php 
// Login CSS
function tigris_login_css() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/css/login.css" />';
}
add_action('login_head', 'tigris_login_css');


// Logo URL
function tigris_login_header_url($url) {
	return esc_url( home_url() );
}
add_filter( 'login_headerurl', 'tigris_login_header_url' );


// Logo TITLE
function tigris_login_header_url_text() {
    return 'Zur Website';
}
add_filter('login_headertext', 'tigris_login_header_url_text');


// Login message below Logo
// function tigris_login_message() {
// 	$message = 'Begrüßungstext';
// 	return $message;
// }
// add_filter('login_message', 'tigris_login_message');

// Login Footer
function tigris_login_copyright() { ?>
    <div id="loginfooter">
        <p>Powered by <a href="http://wordpress.org" target="_blank">WordPress</a>, <br />
        designed & developed by <a href="https://www.designtiger.at/" target="_blank">Designtiger</a>.</p>
    </div>
<?php }
add_action( 'login_footer', 'tigris_login_copyright' );


?>