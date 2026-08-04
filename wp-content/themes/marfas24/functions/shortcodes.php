<?php 

/*************************************************
* General
*************************************************/
/*
function clear( $atts, $content = null ) {
   extract(shortcode_atts(array(), $atts));
   return '<div class="clear"></div>';
}
add_shortcode('clear', 'clear');
*/

/*
function div( $atts, $content = null ) {
   extract(shortcode_atts(array('class' => '', 'style' => '' ), $atts));
   return '<div class="'.$class.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('div', 'div');
*/

function tab( $atts, $content = null ) {
   return '<span class="span90">' . do_shortcode($content) . '</span>';
}
add_shortcode('tab', 'tab');

function strong( $atts, $content = null ) {
   return '<strong>' . do_shortcode($content) . '</strong>';
}
add_shortcode('b', 'strong');

/*************************************************
* Button 
*************************************************/

function button( $atts, $content = null ) {
   return '<span class="button">' . do_shortcode($content) . '</span>';
}
add_shortcode('button', 'button');

function button2( $atts, $content = null ) {
   return '<span class="button ghost">' . do_shortcode($content) . '</span>';
}
add_shortcode('button2', 'button2');

function button3( $atts, $content = null ) {
   return '<span class="button alt">' . do_shortcode($content) . '</span>';
}
add_shortcode('button3', 'button3');


/*************************************************
* Kontakt 
*************************************************/

function name( $atts, $content = null ) {
   $tigris_name = get_field('kontakt_name', 'options');
   return $tigris_name;
}
add_shortcode('name', 'name');

function firma( $atts, $content = null ) {
   $tigris_firma = get_field('kontakt_firma', 'options');
   return $tigris_firma;
}
add_shortcode('firma', 'firma');

function email( $atts, $content = null ) {
   $mymail = get_field('kontakt_mail', 'options');
   $mymail = '<a href="mailto:'.antispambot( $mymail ).'">'.antispambot( $mymail ).'</a>';
   return $mymail;
}
add_shortcode('email', 'email');

function tel( $atts, $content = null ) {
    $tel = get_field('kontakt_tel', 'options'); 
	$telformat = str_replace(' ', '', $tel);
	$telformat = str_replace('/', '', $telformat);
	$telformat = str_replace('-', '', $telformat); 
	$telformat = preg_replace('/^0/', '+43', $telformat);
	// return $telformat;
	return '<a href="tel:' . $telformat . '">' . $tel . '</a>' ;
}
add_shortcode('tel', 'tel');

function adresse( $atts, $content = null ) {
   $myadr = get_field('kontakt_adresse', 'options');
   $myplz = get_field('kontakt_plzort', 'options');
   return $myplz . ', ' . $myadr;
}
add_shortcode('adresse', 'adresse');


/*************************************************
* Remove <p> wrapper from Shortcodes
*************************************************/

function shortcode_empty_paragraph_fix( $content ) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr( $content, $array );
    return $content;
}
add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );

?>