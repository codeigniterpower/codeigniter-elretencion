<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	// initialization of default meta tags
	echo doctype('xhtml1-trans'), PHP_EOL,'<html xmlns="http://www.w3.org/1999/xhtml">', PHP_EOL;
	echo '<head>'. PHP_EOL;
	// the header helper is a custom own project helper that already loads all the necesary headers meta tags
		$this->load->helper('header');
		// setup of our meta tags for currency project
		echo header_meta();
		// loading of own styling and script of project
		echo link_css('bootstrap.css').PHP_EOL;		
		echo link_css('eltxtcss.css').PHP_EOL;
		// loading of datatables for table presentation
		echo link_js("jquery.dataTables.js");
		echo link_css("jquery.dataTables.css");
		// loading of jquery need
		echo link_js('jquery-3.6.3.js');

		// compatibility of older browsers TODO: implement of the 
		echo link_js('polyfill.js').PHP_EOL;
	echo '</head>'. PHP_EOL;
	echo '<body>'.PHP_EOL;
echo '<!-- START MAIN CONTAINER AND MENU TAG CNTAINER , it ends in the footer view -->';
	?>
		<div id="menu" style="height: 60px; margin: 0 0 0 0">
			<center>
					<?php if( isset($menu) ) echo $menu.PHP_EOL ?>
					<?php if( isset($menusub) ) echo $menusub.PHP_EOL ?>
			</center>
		</div>
	<div class="container-fluid">
