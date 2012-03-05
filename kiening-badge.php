<?php
function show_kiening_badge($content) {
	$kiening_options = kw_get_global_options();
	
	$p = $kiening_options['kw_badge_position'];
	$partnerid = $kiening_options['kw_partnerid'];
	
	$colors = array( 1 => "black", 2 => 'blue',   3 => 'green',
					 4 => "red",   5 => "orange", 6 => "yellow",
					 7 => "white", 8 => "grey",   9 => "brown",
					 10 => "water");
					 
	$logo = plugin_dir_url( __FILE__ ) . '/images/Microbutton_' . $colors[$kiening_options['kw_badge_logo']] .".gif";
	$kiening_url     = "http://www.kiening.eu/partner/partnerdoor.php?partnerid=".$partnerid."&amp;bannerid=27";
	$badge = '<div class="kiening-badge"><a href="'. $kiening_url .'" target="_blank" ><img src="' . $logo . '" alt="Kiening Logo" title="Kiening Logo" /></a></div>';
	
	if ($p == 1 or $p == 3)
		$content = $badge . $content;
	
	if ($p == 2 or $p == 3)
		$content = $content . $badge;
	
	return $content;
}

function add_kiening_badge_css() {
	$kiening_options = kw_get_global_options();
	$p = $kiening_options['kw_badge_align'];
	
	if ($p==1)
		$align = "left";
	elseif ($p==2)
		$align = "center";
	else
		$align = "right";
?>
	<style type="text/css">
	.kiening-badge { text-align: <?php echo $align; ?>;}
	</style>
<?php
}

?>