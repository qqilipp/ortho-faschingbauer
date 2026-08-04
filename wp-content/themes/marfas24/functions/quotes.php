<?php // Anführungszeichen
function gerade_anfuehrungszeichen( $translations, $text, $context, $domain ) {
    if ( 'opening curly single quote' == $context && '&#8216;' == $text ) {$translations = '&#39;';}
    if ( 'closing curly single quote' == $context && '&#8217;' == $text ) {$translations = '&#39;';}
    if ( 'opening curly double quote' == $context && '&#8220;' == $text ) {$translations = '&#34;';}
    if ( 'closing curly double quote' == $context && '&#8221;' == $text ) {$translations = '&#34;';}

    return $translations;
}
add_filter( 'gettext_with_context', 'gerade_anfuehrungszeichen', 10, 4 ); ?>