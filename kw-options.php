<?php
/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function kw_options_page_sections() {
	
	$sections = array();
	// $sections[$id] 				= __($title, 'kw_td');
	$sections['partner']	 		= __('Kiening Partner Einstellungen', 'kw_td');
	$sections['badge']	 			= __('Kiening Logo', 'kw_td');
	
	return $sections;	
}

/**
 * Define our form fields (settings) 
 *
 * @return array
 */
function kw_options_page_fields() {

	// fields for kiening partner settings
	$options[] = array(
		"section" => "partner",
		"id"      => KW_SHORTNAME . "_partnerid",
		"title"   => __( 'Kiening Partner ID', 'wptuts_textdomain' ),
		"desc"    => __( 'Bitte geben Sie hier Ihre Kiening Partner ID ein.', 'kw_td' ),
		"type"    => "text",
		"std"     => __('Partner-ID','kw_td'),
		"class"   => "nohtml"
	);
	
	// fields for displaying the badge 
	$imgbase = plugin_dir_url( __FILE__ ) . '/images/';
	$options[] = array(
		"section" => "badge",
		"id"      => KW_SHORTNAME . "_badge_logo",
		"title"   => __( 'Kiening Logo', 'kw_td' ),
		"desc"    => __( 'Bitte wählen Sie ein Logo zur Anzeige in Ihren Artikeln aus.', 'kw_td' ),
		"type"    => "select2",
		"std"    => "",
		"class" => "imageselector",
		"choices" => array( __('schwarz','kw_td') . "|1", 
							__('blau','kw_td')    . "|2",
							__('grün','kw_td')    . "|3",
							__('rot','kw_td')     . "|4",
							__('orange','kw_td')  . "|5",
							__('gelb','kw_td')    . "|6",
							__('weiß','kw_td')    . "|7",
							__('grau','kw_td')    . "|8", 
							__('braun','kw_td')   . "|9",
							__('aqua', 'kw_td')   . "|10")
		
	);	
	
	$options[] = array(
		"section" => "badge",
		"id"      => KW_SHORTNAME . "_badge_position",
		"title"   => __( 'Kiening Logo anzeigen', 'kw_td' ),
		"desc"    => __( 'Geben Sie an wo das kleine Kiening Logo angezeigt werden soll.', 'kw_td' ),
		"type"    => "select2",
		"std"    => "",
		"choices" => array( __('Oben','kw_td') . "|1", __('Unten','kw_td') . "|2", 
							__('Oben und Unten','kw_td') . "|3", __('kein Anzeige','kw_td') . "|0")
	);
	
	$options[] = array(
		"section" => "badge",
		"id"      => KW_SHORTNAME . "_badge_align",
		"title"   => __( 'Kiening Logo Ausrichtung', 'kw_td' ),
		"desc"    => __( 'Geben Sie an wie das Logo ausgerichtet werden soll.', 'kw_td' ),
		"type"    => "select2",
		"std"    => "",
		"choices" => array( __('links','kw_td') . "|1", __('zentriert','kw_td') . "|2", __('rechts','kw_td') . "|3")
	);	
	
	return $options;	
}

/**
 * Contextual Help
 */
function kw_options_page_contextual_help() {
	
	$text 	= "<h3>" . __('Kiening Plugin Einstellungen - Kontexthilfe','kw_td') . "</h3>";
	$text 	.= "<p>" . __('Auf dieser Seite finden Sie die Einstellungen für die Anzeige des Kiening Logos in jedem Artikel oder auf jeder Seite.','kw_textdomain') . "</p>";
	$text   .= "<p>" . "Das Kiening-Partner-Plugin bietet die Möglichkeit ein Banner-Widget auf Ihrer Wordpress Seite anzuzeigen.
						Weiterhin können kleine Link-Logos auf jeder Seite, jedem Artikel eingeblendet werden.
						Zur Verwendung des Plugins benötigen Sie eine Kiening-Partner-ID, die Sie unter http://www.kiening.eu/partner
						beantragen können.</p>";
	
	// must return text! NOT echo
	return $text;
} 
?>