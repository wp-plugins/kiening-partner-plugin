<?php
/*
Plugin Name: Kiening-Partner-Plugin
Plugin URI: http://www.kiening.eu
Description: Das Kiening-Partner-Plugin stellt ein Widget und die Möglichkeit ein Kiening Logo in Seiten und Artikeln anzuzeigen bereit. 
			 Die optimale Blog-ergänzung für alle die am Kiening Partner Program unter http://www.kiening.eu/partner teilnehmen.
Version: 0.7
Author: Hans Matzen
Author URI: http://www.tuxlog.de
*/

/*  
    Copyright 2012 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


/* ---------- no parameters to change after this point -------------------- */

// load the widget class
require_once("class_widget.php");
// load the admin dialog if applicaple
if(is_admin()){
	require_once('kw-settings.php');
}
require_once('kiening-badge.php');

// MAIN
function kiening_widget_init() {
		register_widget( 'Kiening_Widget' );
}

function kw_get_global_options(){
	$kw_option    = array();
	$kw_option 	= get_option('kw_option');

	return $kw_option;
}

// instantiate widget from class
add_action('widgets_init', 'kiening_widget_init');
add_action("wp_head","add_kiening_badge_css");
add_filter('the_content', 'show_kiening_badge');
?>
