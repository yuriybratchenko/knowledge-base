<?php
/**
 * SVG Icons class
 *
 * @package    Kb
 * @subpackage Class
 */

class KB_SVG_Icons {

	public static function get_svg( $icon = '', $classes = array() ) {
		$arr = self::$ui_icons;

		$classes   = (array) $classes;
		$classes[] = 'svg-icon';

		if ( array_key_exists( $icon, $arr ) ) {
			$repl = sprintf( '<svg class="%s" ', join( ' ', $classes ) );
			$svg  = preg_replace( '/^<svg /', $repl, trim( $arr[ $icon ] ) ); // Add extra attributes to SVG code.
			$svg  = preg_replace( "/([\n\t]+)/", ' ', $svg ); // Remove newlines & tabs.
			$svg  = preg_replace( '/>\s*</', '><', $svg ); // Remove white space between SVG tags.

			return $svg;
		}

		return null;
	}

	static $ui_icons = array(
		'article'      => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.5"><path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM14 17H7V15H14V17ZM17 13H7V11H17V13ZM17 9H7V7H17V9Z" fill="#64748B"/></g></svg>',
		'youtube'      => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.5"><path d="M22.0617 6.93984C21.9422 6.49462 21.7078 6.0886 21.382 5.76243C21.0563 5.43625 20.6505 5.20136 20.2055 5.08125C18.5672 4.64063 12 4.64062 12 4.64062C12 4.64062 5.43281 4.64062 3.79453 5.07891C3.34927 5.19862 2.94334 5.43339 2.61751 5.75962C2.29169 6.08586 2.05744 6.49208 1.93828 6.9375C1.5 8.57812 1.5 12 1.5 12C1.5 12 1.5 15.4219 1.93828 17.0602C2.17969 17.9648 2.89219 18.6773 3.79453 18.9188C5.43281 19.3594 12 19.3594 12 19.3594C12 19.3594 18.5672 19.3594 20.2055 18.9188C21.1102 18.6773 21.8203 17.9648 22.0617 17.0602C22.5 15.4219 22.5 12 22.5 12C22.5 12 22.5 8.57813 22.0617 6.93984ZM9.91406 15.1406V8.85938L15.3516 11.9766L9.91406 15.1406Z" fill="#FA5450"/></g></svg>',
		'article-tips' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.5"><path d="M20 3H4C2.9 3 2 3.9 2 5V23L6 19H20C21.1 19 22 18.1 22 17V5C22 3.9 21.1 3 20 3ZM13.57 12.57L12 16L10.43 12.57L7 11L10.43 9.43L12 6L13.57 9.43L17 11L13.57 12.57Z" fill="#0CB6B3"/></g></svg>',
        'feature'      => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.5"><path d="M12 16.575L13.4 13.4L16.575 12L13.4 10.6L12 7.425L10.6 10.6L7.425 12L10.6 13.4L12 16.575ZM4.5 21C4.1 21 3.75 20.85 3.45 20.55C3.15 20.25 3 19.9 3 19.5V4.5C3 4.1 3.15 3.75 3.45 3.45C3.75 3.15 4.1 3 4.5 3H19.5C19.9 3 20.25 3.15 20.55 3.45C20.85 3.75 21 4.1 21 4.5V19.5C21 19.9 20.85 20.25 20.55 20.55C20.25 20.85 19.9 21 19.5 21H4.5Z" fill="#0DC167"/></g></svg>',
        'article-troubleshoot' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.5"><path d="M22.7004 18.9998L13.6004 9.89977C14.5004 7.59977 14.0004 4.89977 12.1004 2.99977C10.1004 0.999768 7.10043 0.599768 4.70043 1.69977L9.00043 5.99977L6.00043 8.99977L1.60043 4.69977C0.400428 7.09977 0.900428 10.0998 2.90043 12.0998C4.80043 13.9998 7.50043 14.4998 9.80043 13.5998L18.9004 22.6998C19.3004 23.0998 19.9004 23.0998 20.3004 22.6998L22.6004 20.3998C23.1004 19.9998 23.1004 19.2998 22.7004 18.9998Z" fill="#4272F9"/></g></svg>',
    );
}


function kb_get_icon_svg( $icon = '', $classes = array() ) {
	return KB_SVG_Icons::get_svg( $icon, $classes );
}