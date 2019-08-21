<?php
   /*
   Plugin Name: Wanna Internet &trade; ISP Coverage Checker
   Plugin URI: https://www.wanna.net.nz
   Description: This plugin will check your NZ ISP coverage
   Version: 2.03
   Author: Paul Willard
   Author URI: https://www.paulwillard.nz
   License: GPL2
   */

class Wanna_isp_coverage_check_Plugin {
  private static $_this;
  var $request_data=Array();
  var $pass_tick="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAABX1BMVEUAAAD///8AgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgAAAgADjQUWMAAAAdHRSTlMAAAMEBQcICQoLDA0OERIVGhweHyAiJicoKTQ3OTo8PT4/QUJDREZHSElKTE1OT1BRUlVWV1hlbHByfIGKjY+RkpOVlpeZmpudnp+gpKizubrAxcjL0NHU1dba29zd3t/g4eLj5Obn6u3x8vb3+Pn6+/z9/rjpI9IAAAGXSURBVHjaldNlU4JREIbhRwVRLCzsQMTuxAYMDOwEUVCwE9z/P47DoPsuisv9kTPX8DCHg7ycg7q5w1kAyIG4X+g5YMuFNNFXd2N6Yj6nVN58LfFRup0ynXDRT9sqYb1i5ExF/Ew8DGhED7FmNT+/JM5EsEBDNojVrLmXPi4WwIhqVsisIZvEaoOC9HLhgYJY+ayLQg1ZJ5YDjKgu0QsFscaYuLRoiJ9YHVCQLi58UBDrtWGWhqwRywlBxvd327O9RFqGIG4iehNPp5i/xEiRIDP0VXIYvFU5i5NpSvXBTaecxcnE90lyBOmKomIWJ4OP9GOG0gcrchYnx/ww0Z/63Gm8REGWiPfeCwCWiOESJTFtGcxrNwCf+G8Jgvw9o3HJWZkElgODeRo9FbMyCUqPSCZnSYLyE5LJWZKgIkgyOUsS2EK/Egf+JqgM/yI8yEZQHckQ4cLsBDVRSVrxD0FtzCgW8S+BPc5FyKwgsN8w0gINQf3tt5iHjqAh/T1Bk5agLpYijVATVO0niO6nkANBcYAeJ5GFfALim1ahvYNQYwAAAABJRU5ErkJggg==";
  var $fail_x="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAA6lBMVEUAAAD/////AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAD/AAAyGiRLAAAATXRSTlMAABYXGBkaGxwdHh8hIiMkJSYoKissLS4vMDEyMzU2Nzg5Ozw+QUNFR0pPW15izNHT1NXW19na29zd3t/h4uPk5ebn6Onq6+3u7/Dx8iW5/CgAAAG5SURBVHgBfdXrktJAEIbhju7GrIIIiKgogoriWRFDUCCIByBx7v92ZCrbVZO8ZPrPViX1VH89S09Ea/BWvPXuRfE3CPTJjY/pI58Y7D6FZRJ+Neb4tF4MM2PiyCVRbE6VDWtFbt8vIiUqTmZ0XjzLivdxpESFMf/GdUJNQaKFMY6hyPWtzWbJTe1RmJFwcqfiy0Bezkyp8hGFW/OJTH8YLfahMKs3IndWBn3qxaZhx2+q4RlQtIpDvrtGtjpxTyyxhtnqhCVqmG2YUyg5m61/n0Jcwj6HAyaXMuG5UVQI+zAVCAx7gDAbhRIaChI163MiVUHCeXRyH5GLpCq+X4qfPEirZPsQhDuI3zUI7isaEPSAGZPg9oEBQSpmA2Eq7ikIBPtUCMR+T+MSTr7vdv7iDFwC8acv0vtNo4SpfvXs4+5PGCUQu27RvLOlsYT/j21HD6W9wRlY8rgq0raIVgv325NA3h+5tb6dyz7I65lP8D6YT0Uu4vqt5d2bhO7nlYJmeeV+xCk4T3JbLFHDOTBPciVKrrOl7FHKtjwJJbYPesDYHg6R8POiKZ5qfPtyq7pi41firclzXbH/KOh5UddfR+MAAAAASUVORK5CYII=";
  public function __construct() {
  	// Don't allow more than one instance of the class
    if ( isset( self::$_this ) ) {
    	wp_die( sprintf( __( '%s is a singleton class and you cannot create a second instance.', 'wanna-isp-coverage-check' ),
    		get_class( $this ) ));
    }
    self::$_this = $this;
    add_action( 'admin_menu', array( $this, 'wanna_address_checker_admin_menu' ) );
    add_action( 'admin_menu', array( $this, 'wanna_address_checker_admin_submenu' ) );
    add_action( 'admin_menu', array( $this, 'wanna_address_checker_admin_submenu2' ) );
    add_action( 'admin_menu', array( $this, 'wanna_address_checker_admin_submenu3' ) );
    add_action('init', array( $this, 'register_frontend_web_script'));
    add_action('init', array( $this, 'register_shortcodes'));
    add_action('init', array( $this, 'store_request_data'));
    add_action( 'admin_init', array( $this, 'setup_sections' ) );
    add_action( 'admin_init', array( $this, 'setup_fields' ) );
    register_activation_hook( __FILE__, array( $this, 'create_plugin_database_table' ) );
    register_deactivation_hook( __FILE__, array( $this, 'drop_plugin_database_table' ) );
  }

  static function get_this() {
  	return self::$_this;
  }

  public function register_shortcodes() {
  	add_shortcode('wanna-isp-coverage-check-form', array( $this, 'wanna_address_checker_form'));
    add_shortcode('wanna-isp-coverage-check-results', array( $this, 'wanna_address_checker_results'));
  }

  public function wanna_address_checker_admin_menu() {
    // Add the menu item and page
    $page_title = 'Wanna Internet ISP Coverage Checker';
    $menu_title = 'ISP Coverage Check';
    $capability = 'administrator';
    $menu_slug  = 'wanna-isp-coverage-check';
    $function   = array( $this, 'wanna_isp_coverage_check_page');
    $icon_url   = 'dashicons-networking';
    $position   = 97;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  }

  public function wanna_address_checker_admin_submenu() {
    // Add the menu item and page
    $parent		= 'wanna-isp-coverage-check';
    $page_title = 'Address lookups log';
    $menu_title = 'Log of all searches';
    $capability = 'administrator';
    $menu_slug  = 'wanna-isp-coverage-check-log';
    $function   = array( $this, 'wanna_isp_coverage_check_log');

    add_submenu_page( $parent, $page_title, $menu_title, $capability, $menu_slug, $function );
  }

  public function wanna_address_checker_admin_submenu2() {
    // Add the menu item and page
    $parent		= 'wanna-isp-coverage-check';
    $page_title = 'Maintenance';
    $menu_title = 'DB Maintenance';
    $capability = 'administrator';
    $menu_slug  = 'wanna-isp-coverage-check-maintenance';
    $function   = array( $this, 'wanna_isp_coverage_check_maintenance');

    add_submenu_page( $parent, $page_title, $menu_title, $capability, $menu_slug, $function );
  }

  public function wanna_address_checker_admin_submenu3() {
    // Add the menu item and page
    $parent   = 'wanna-isp-coverage-check';
    $page_title = 'About &amp; Credits';
    $menu_title = 'About &amp; Credits';
    $capability = 'administrator';
    $menu_slug  = 'wanna-isp-coverage-check-about';
    $function   = array( $this, 'wanna_isp_coverage_check_about');

    add_submenu_page( $parent, $page_title, $menu_title, $capability, $menu_slug, $function );
  }

  function create_plugin_database_table() {
    global $wpdb;
    $tblname = 'wanna_isp_coverage_check';
    $wp_track_table = $wpdb->prefix . "$tblname";

    $sql = "CREATE TABLE IF NOT EXISTS $wp_track_table ( ";
    $sql .= "  `id`  int(11) NOT NULL auto_increment, ";
    $sql .= "  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, ";
    $sql .= "  `ipaddress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL, ";
    $sql .= "  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL, ";
    $sql .= "  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL, ";
    $sql .= "  PRIMARY KEY `id` (`id`), ";
    $sql .= "  KEY `datetime` (`datetime`) ";
    $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; ";
    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    dbDelta($sql);
  }

  function drop_plugin_database_table() {
    global $wpdb;
    $tblname = 'wanna_isp_coverage_check';
    $wp_track_table = $wpdb->prefix . "$tblname";

    $sql = "DROP TABLE IF EXISTS $wp_track_table; ";
    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    dbDelta($sql);
  }

  function store_request_data() {
  	if( isset( $_REQUEST) ) {
  		$this->request_data = $_REQUEST;
  		$this->request_data["ipaddress"] = $this->get_the_user_ip();
    };
  }

  public function register_frontend_web_script() {
    wp_register_script( 'wanna_custom_js_places', plugins_url('/js/places.js', __FILE__), array('jquery'), '2.5.1' );
    wp_register_script( 'wanna_custom_js', plugins_url('/js/wanna_isp_coverage_checker.js', __FILE__), array('jquery'), '2.5.1' );
  }

  public function enqueue_frontend_web_style() {
    wp_enqueue_script('wanna_custom_js_places');
    wp_enqueue_script('wanna_custom_js', '', '', NULL, TRUE); // add to the footer
  }

  public function wanna_address_checker_form() {
    $this->enqueue_frontend_web_style();
    $results_page = get_option('results_page');
    $custom_css=get_option('form_custom_css');
    if(isset($this->request_data['address_check_field'])) { $address=strip_tags($this->request_data['address_check_field']); }
    $form_html = '
    <style>
    '.$custom_css.'
    </style>
    <div id="address_check_container">
    <form method="post" action="'.$results_page.'" id="address_check">
    <input type="text" id="address_check_field" value="'.$address.'" name="address_check_field" placeholder="Check your coverage ...." autofocus="" accesskey="q" />
    <input type="submit" id="address_check_submit" class="button" value="Search" />
    </form>
    </div>
    <div style="clear:both;"></div>
    ';
    return $form_html;
  }

  public function wanna_address_checker_results() {
    $custom_css=get_option('results_custom_css');
    $ipaddress=$this->request_data["ipaddress"];
    if(isset($this->request_data['address_check_field'])) {
    	$address=strip_tags($this->request_data['address_check_field']);
    	if(isset($address) AND $address != "") {
        $geodata=$this->get_lat_long($address);
        $internetNZresult=$this->get_internetNZ_json($geodata["lat"], $geodata["lon"]);
        if($this->in_array_r("Available", $internetNZresult)==TRUE) { $address_check_results="PASS"; } else { $address_check_results="FAIL"; };
    		$this->wanna_address_checker_store_search_results($ipaddress, $address, $address_check_results);
    	}
	    $results_html = '
	    <style>
	    '.$custom_css.'
	    </style>
	    <div id="address_check_results_container">
        <h3 class="resultsHeader">
      ';
      $results_html .= ($address_check_results=="PASS" ? "Yay! Looks like you’re in coverage! Complete your signup " : "Boo :( You might not have any coverage, we have to check manually" );
      $results_html .= '
        </h3>
	    	<div class="hidden_debug_data" style="display: none;">'.$address.' | '.$ipaddress.' | lat: '.$geodata["lat"].' | long: '.$geodata["lon"].' | '.$address_check_results.'</div>
      ';
      if($address_check_results=="PASS") {
        $results_html .= '
        <table class="resultsTabulated">
        <tbody>
  	    ';
        foreach ($internetNZresult["results"] as $result) {
          $result_icon=($result["availability"]=="Available" ? "<img src='".$this->pass_tick."' />" : "<img src='".$this->fail_x."' />" );
          $results_html .= "<tr><td>".$result_icon."</td><td>".$result["technology"]."</td></tr>";
        }
        $results_html .= '
        </tbody>
        </table>
        ';
      }
      $results_html .= '
          <div class="internetnzlink">Data provided by: <a href="https://broadbandmap.nz/" target="_blank">The National broadband map</a></div>
          </div>
      <div style="clear:both;"></div>';
	   }
    return $results_html;
  }

  public function wanna_address_checker_store_search_results($ip, $address, $checkresults) {
  	global $wpdb;
  	$tblname = 'wanna_isp_coverage_check';
    $wp_track_table = $wpdb->prefix . "$tblname";
  	$wpdb->insert($wp_track_table,
  		Array(
  			'ipaddress' => $ip,
  			'address' => $address,
  			'result' => $checkresults
  		)
  	);
  }

  function get_the_user_ip() {
  	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
  		//check ip from the web
  		$ip = $_SERVER['HTTP_CLIENT_IP'];
  	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
  		//check ip from proxy
  		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  	} else {
  		$ip = $_SERVER['REMOTE_ADDR'];
  	}
  	return apply_filters( 'wpb_get_ip', $ip );
  }

  function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
  }

  public function wanna_isp_coverage_check_page() {
  ?>
  <h1>Wanna Internet &trade; ISP Coverage Checker</h1>
  <h2>Usage:</h2>
  <p>Insert the short code [wanna-isp-coverage-check-form] to display the form on any page or post.</p>
  <p>Insert the short code [wanna-isp-coverage-check-results] to display the results on any page or post.</p>
  <form method="post" action="options.php">
    <?php 
    settings_fields( 'wanna-isp-coverage-check' );
    do_settings_sections( 'wanna-isp-coverage-check' );
    submit_button();
    ?>
  </form>
  <hr />
  Copyright &copy; - <a href="https://www.wanna.net.nz" target="_blank">Wanna Internet</a> Limited &trade; <?php echo date("Y"); ?><br />
  Author: Paul Willard <a href="https://paulwillard.nz" target="_blank">https://paulwillard.nz</a>

  <?php
  }

  public function wanna_isp_coverage_check_log() {
  	global $wpdb;
    $tblname = 'wanna_isp_coverage_check';
    $wp_track_table = $wpdb->prefix . "$tblname";
    $paginateHTML="";
    if(isset($_GET["orderBy"])) {
    	$orderSQL=$_GET["orderBy"]." DESC";
    	$orderSQL = (empty($_GET["orderBy"]) ? "datetime DESC" : $orderSQL);
    	$orderGET = $_GET["orderBy"];
    } else {
    	$orderSQL="datetime DESC";
    }

    if(isset($_GET["filter"])) {
    	$filterSQL="WHERE result='".$_GET["filter"]."'";
    	$filterSQL = (empty($_GET["filter"]) ? "" : $filterSQL);
    	$filterGET = $_GET["filter"];
    } else {
    	$filterSQL="WHERE 1";
    }

    if(isset($_GET["offset"])) {
    	$offsetSQL=" OFFSET ".$_GET["offset"];
    	$offsetSQL = (empty($_GET["offset"]) ? "" : $offsetSQL);
    	$offsetGET = $_GET["offset"];
    } else {
    	$offsetSQL="OFFSET 0";
    }
    $rowcount=$wpdb->get_var("SELECT count(id) FROM $wp_track_table");
    $rowcountFilter=$wpdb->get_var("SELECT count(id) FROM $wp_track_table $filterSQL");
    if($rowcountFilter>20) {
    	if($offsetGET=="" OR $offsetGET==0) {
    		$offsetGETNext=intval($offsetGET)+20;
    		$paginateHTML.="<a href=\"?page=wanna-isp-coverage-check-log&offset=$offsetGETNext&orderBy=$orderGET&filter=$filterGET\">Next Page >></a>";
    	} else {
    		$offsetGETNext=intval($offsetGET)+20;
    		$offsetGETPrev=intval($offsetGET)-20;
    		$paginateHTML.="<a href=\"?page=wanna-isp-coverage-check-log&offset=$offsetGETPrev&orderBy=$orderGET&filter=$filterGET\"><< Previous Page</a> | ";
    		$paginateHTML.="<a href=\"?page=wanna-isp-coverage-check-log&offset=$offsetGETNext&orderBy=$orderGET&filter=$filterGET\">Next Page >></a>";
    	}
    }

  ?>
  <h1>Wanna Internet &trade; ISP Coverage Checker Log</h1>
  <p>A log of all the address lookup queries.</p>
  <hr />
  <h2>Search options</h2>
  <p>Order results by: <a href="?page=wanna-isp-coverage-check-log&offset=<?php echo $offsetGET; ?>&orderBy=datetime&filter=<?php echo $filterGET; ?>">Date</a>, <a href="?page=wanna-isp-coverage-check-log&offset=<?php echo $offsetGET; ?>&orderBy=ipaddress&filter=<?php echo $filterGET; ?>">IP address</a>, <a href="?page=wanna-isp-coverage-check-log&offset=<?php echo $offsetGET; ?>&orderBy=address&filter=<?php echo $filterGET; ?>">Address</a>, <a href="?page=wanna-isp-coverage-check-log&offset=<?php echo $offsetGET; ?>&orderBy=result&filter=<?php echo $filterGET; ?>">Result</a></p>
  <p>Show <a href="?page=wanna-isp-coverage-check-log&offset=<?php echo $offsetGET; ?>&orderBy=<?php echo $orderGET; ?>&filter=FAIL">Failed</a> / <a href="?page=wanna-isp-coverage-check-log&offset=<?php echo $offsetGET; ?>&orderBy=<?php echo $orderGET; ?>&filter=PASS">Passed</a> / <a href="?page=wanna-isp-coverage-check-log&offset=<?php echo $offsetGET; ?>&orderBy=<?php echo $orderGET; ?>">All</a> results</p>
  <hr />
  <h2>Log Entries</h2>
  <h4> Order by: <span style="color: red;"><?php echo $orderSQL; ?></span></h4>
  <h4> Filter by: <span style="color: red;"><?php echo $filterGET; ?></span></h4>
  <h4> Total number of entires:<span style="color: red;"><?php echo $rowcount; ?></span></h4>
  <h4> Total number of Filtered entires:<span style="color: red;"><?php echo $rowcountFilter; ?></span></h4>
  <table>
  	<tr>
  		<th>Datetime</th>
  		<th>ip address</th>
  		<th>Address</th>
  		<th>Result</th>
  	</tr>
  <?php
  	$rowcount=$wpdb->get_var("SELECT * FROM $wp_track_table $filterSQL");
   	foreach( $wpdb->get_results( "SELECT * FROM $wp_track_table $filterSQL ORDER BY $orderSQL LIMIT 20 $offsetSQL" ) as $key => $row) {
   		echo "<tr><td>".$row->datetime."</td><td>".$row->ipaddress."</td><td>".$row->address."</td><td>".$row->result."</td></tr>";
  	}
  ?>
  </table>
  <div class="pagination"><?php echo $paginateHTML; ?></div>
  <hr />
  Copyright &copy; - <a href="https://www.wanna.net.nz" target="_blank">Wanna Internet</a> Limited &trade; <?php echo date("Y"); ?><br />
  Author: Paul Willard <a href="https://paulwillard.nz" target="_blank">https://paulwillard.nz</a>

  <?php
  }

  public function wanna_isp_coverage_check_maintenance() {
  	global $wpdb;
    $tblname = 'wanna_isp_coverage_check';
    $wpdb->show_errors();
    $wp_track_table = $wpdb->prefix . "$tblname";
    if($_GET["optimizeTable"]=="1") {
    	$wpdb->query( "OPTIMIZE TABLE $wp_track_table");
    	if($wpdb->last_error !== '') {
    		$opt_output  = "<span> - An SQL error occured:";
			$opt_output .= $wpdb->last_error;
			$opt_output .= "</span>";
    	} else {
    		$opt_output = "<span> - Successfully optimized table</span>";
    	}
    }
    if(isset($_GET["pruneDate"]) AND $_GET["pruneDate"] != "")	 {
    	$pruneDate=$_GET["pruneDate"];
    	$query = "DELETE FROM $wp_track_table where `datetime` < '$pruneDate'";
    	$rowcount=$wpdb->get_var("SELECT count(*) FROM $wp_track_table where `datetime` < '$pruneDate'");
    	$wpdb->query($query);
    	if($wpdb->last_error !== '') {
    		$prune_output  = "<span> - An SQL error occured:";
			$prune_output .= $wpdb->last_error;
			$prune_output .= "</span>";
    	} else {
    		$prune_output = "<span> - $rowcount entries deleted; old than $pruneDate</span>";
    	}
    }

  ?>
  <h1>Wanna Internet &trade; ISP Coverage Checker DB Maintenance</h1>
  <p>Preform DB Maintenance on the logs.</p>
  <hr />
  <p><strong><span style="color:red;">Warning !!</span></strong> this does not ask for any confirmation, it will run these commands without an hesitation</p>
  <p><a href="?page=wanna-isp-coverage-check-maintenance&optimizeTable=1">Optimize table</a><?php echo $opt_output; ?></p>
  <form method="GET" action="" />
  <p>Prune table before date <input type="hidden" name="page" value="wanna-isp-coverage-check-maintenance" /><input type="date" name="pruneDate" value="<?php echo $pruneDate; ?>" /><input type="submit" value="PRUNE !" /></p>
  <p><?php echo $prune_output; ?></p>
  </form>
  <hr />
  Copyright &copy; - <a href="https://www.wanna.net.nz" target="_blank">Wanna Internet</a> Limited &trade; <?php echo date("Y"); ?><br />
  Author: Paul Willard <a href="https://paulwillard.nz" target="_blank">https://paulwillard.nz</a>

  <?php
  }

  public function wanna_isp_coverage_check_about() {
    include_once(dirname(__FILE__).'/Parsedown.php');
    $Parsedown = new Parsedown();
    ?>
    <h1>About Wanna Internet &trade; ISP Coverage Checker</h1>
    <hr />
    <?php echo $Parsedown->text(file_get_contents(dirname(__FILE__)."/README.md")); ?>
    <hr />
    Copyright &copy; - <a href="https://www.wanna.net.nz" target="_blank">Wanna Internet</a> Limited &trade; <?php echo date("Y"); ?><br />
    Author: Paul Willard <a href="https://paulwillard.nz" target="_blank">https://paulwillard.nz</a>

    <?php
  }

  public function setup_sections() {
    add_settings_section( 'our_first_section', 'Required fields', array( $this, 'section_callback' ), 'wanna-isp-coverage-check' );
    add_settings_section( 'our_second_section', 'Customise CSS', array( $this, 'section_callback' ), 'wanna-isp-coverage-check' );
  }

  public function section_callback( $arguments ) {
	switch( $arguments['id'] ){
        case 'our_first_section':
            echo 'These fields are <strong><span style="color: red;">required</span></strong> to make the plugin work :)';
            break;
        case 'our_second_section':
            echo 'Customise the CSS of the form and the results';
            break;
        case 'our_third_section':
            echo 'Third time is the charm!';
            break;
    }
  }

  public function setup_fields() {
    $pages = get_pages();
    $options=Array(''=>'Select a page ... ');
    foreach ( $pages as $page ) {
      $options[get_page_link($page->ID)]=$page->post_title;
    }
    $fields = array(
        array(
            'uid' => 'api_key',
            'label' => 'InternetNZ API Key',
            'section' => 'our_first_section',
            'type' => 'text',
            'options' => false,
            'placeholder' => 'xxxYYabcQWE',
            'helper' => 'Get a key from InternetNZ',
            'supplemental' => '<a href="https://docs.internetnz.nz/broadbandmap/">https://docs.internetnz.nz/broadbandmap/</a>',
            'default' => ''
        ),
        array(
            'uid' => 'internetNZ_staging',
            'label' => 'Use the InternetNZ Staging area',
            'section' => 'our_first_section',
            'type' => 'select',
            'options' => Array('yes'=>'yes', 'no'=>'no'),
            'placeholder' => 'Are you using the staging area ?',
            'helper' => 'Use the staging area?',
            'supplemental' => 'staging: https://api-stage.broadbandmap.nz/api/1.0/availability/yx/$latitude/$longitude?api_key=$key<br />Production: https://api.broadbandmap.nz/api/1.0/availability/yx/$latitude/$longitude?api_key=$key',
            'default' => ''
        ),
        array(
            'uid' => 'locationiq_key',
            'label' => 'LocationIQ API Key',
            'section' => 'our_first_section',
            'type' => 'text',
            'options' => false,
            'placeholder' => 'xxxYYabcQWE',
            'helper' => 'Get a key from Location IQ',
            'supplemental' => '<a href="https://locationiq.com/">https://locationiq.com/</a>',
            'default' => ''
        ),
        array(
            'uid' => 'results_page',
            'label' => 'The page you want to display results on',
            'section' => 'our_first_section',
            'type' => 'select',
            'options' => $options,
            'placeholder' => 'Select a page ...',
            'helper' => '',
            'supplemental' => 'When somebody searches their address the result will be POST\'ed to this page.<br />This page needs to exist. <br />Hint: add the short code [wanna-isp-coverage-check-results] on this page',
            'default' => ''
        ),
        array(
            'uid' => 'form_custom_css',
            'label' => 'Form CSS',
            'section' => 'our_second_section',
            'type' => 'textarea',
            'options' => $options,
            'placeholder' => '.address_check_container {
				padding: 0 20px;
				width: 60%;
				}',
            
            'helper' => '<br />
            The form outputs the following HTML:
            	<pre>
&lt;div id="address_check_container"&gt;
	&lt;form method="post" action="#" id="address_check"&gt;
	&lt;nput type="text" id="address_check_field" value="" placeholder="Check your coverage ...." autofocus="" accesskey="q" /&gt;
	&lt;input type="submit" id="address_check_submit" class="button" value="Search" /&gt;
	&lt;/form&gt;
&lt;/div&gt;
&lt;div style="clear:both;"&gt;&lt;/div&gt;
			    </pre>
            ',
            'supplemental' => 'Make the form look like you want :)',
            'default' => ''
        ),
        array(
            'uid' => 'results_custom_css',
            'label' => 'Results CSS',
            'section' => 'our_second_section',
            'type' => 'textarea',
            'options' => $options,
            'placeholder' => '.address_check_results_container {
				padding: 0 20px;
				width: 60%;
				}',
            
            'helper' => '<br />
            The results outputs the following HTML:
            	<pre>
&lt;div id="address_check_results_container"&gt;
  &lt;h3 class="resultsHeader"&gt;
  Yay! Looks like you’re in coverage! Complete your signup 
  &lt;/h3&gt;
  &lt;div class="hidden_debug_data" style="display: none;"&gt;96 Cambridge Road, Hamilton, Waikato, New Zealand | 10.255.255.213 | lat: -37.7981442 | long: 175.3145347 | PASS&lt;/div&gt;
  &lt;table class="resultsTabulated"&gt;
    &lt;tbody&gt;
      &lt;tr&gt;
        &lt;td&gt;Available&lt;/td&gt;&lt;td&gt;Fibre&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td&gt;Not Available&lt;/td&gt;&lt;td&gt;Cable&lt;/td&gt;
        .... (continued for each technology type)
    &lt;/tbody&gt;
  &lt;/table&gt;
  &lt;div class="internetnzlink"&gt;Data provided by: &lt;a href="https://broadbandmap.nz/" target="_blank"&gt;The National broadband map&lt;/a&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;div style="clear:both;"&gt;&lt;/div&gt;
			    </pre>
            ',
            'supplemental' => 'Make the results look like you want :)',
            'default' => ''
        )
    );
    foreach ($fields as $field) {
      add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'wanna-isp-coverage-check', $field['section'], $field );
      register_setting('wanna-isp-coverage-check', $field['uid']);
    }
  }

  public function field_callback( $arguments ) {
    $value = get_option( $arguments['uid'] ); // Get the current value, if there is one
    if( ! $value ) { // If no value exists
        $value = $arguments['default']; // Set to our default
    }
    // Check which type of field we want
    switch( $arguments['type'] ){
      case 'text': // If it is a text field
          printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
          break;
      case 'textarea': // If it is a textarea
          printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
          break;
      case 'select': // If it is a select dropdown
          if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
              $options_markup = '';
              foreach( $arguments['options'] as $key => $label ){
                  $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value, $key, false ), $label );
              }
              printf( '<select name="%1$s" id="%1$s">%2$s</select>', $arguments['uid'], $options_markup );
          }
      break;
    }

    // If there is help text
    if( $helper = $arguments['helper'] ){
        printf( '<span class="helper"> %s</span>', $helper ); // Show it
    }
    // If there is supplemental text
    if( $supplimental = $arguments['supplemental'] ){
        printf( '<p class="description">%s</p>', $supplimental ); // Show it
    }
  }

  public function get_lat_long( $address ) {
    $geoip=Array();
    $locationip_com_key=get_option('locationiq_key');
    $fulladdress=urlencode($address);
    $geoipUrl = "https://us1.locationiq.com/v1/search.php?key=".$locationip_com_key."&q=".$fulladdress."&format=json";
    $options = array(
      'http'=>array(
      'method'=>"GET",
      'header'=>"Accept-language: en\r\n" .
                "Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
                "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/ 531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
      )
    );
    $context = stream_context_create($options);
    $contents = file_get_contents($geoipUrl, false, $context);
    $contents = utf8_encode($contents);
    $json = json_decode($contents, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        if(isset($json[0]['lat'])) {
        $geoip["lat"]=$json[0]['lat'];
        $geoip["lon"]=$json[0]['lon'];
        } else {
            $geoip["lat"]="-37.785023";
            $geoip["lon"]="174.768470";
        }
    }
    return $geoip;
  }

  public function get_internetNZ_json( $lat, $long ) {
    $geoip=Array();
    $api_key=get_option('api_key');
    $staging=get_option('internetNZ_staging');
    $internetnz_url = ($staging == 'yes' ? "https://api-stage.broadbandmap.nz/api/1.0/availability/yx/$lat/$long?api_key=$api_key" : "https://api.broadbandmap.nz/api/1.0/availability/yx/$lat/$long?api_key=$api_key"); 
    $options = array(
      'http'=>array(
      'method'=>"GET",
      'header'=>"Accept-language: en\r\n" .
                "Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
                "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/ 531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
      )
    );
    $context = stream_context_create($options);
    $contents = file_get_contents($internetnz_url, false, $context);
    $contents = utf8_encode($contents);
    $json = json_decode($contents, true);
    if (json_last_error() === JSON_ERROR_NONE) {
      return $json;
    }
    return NULL;
  }

}

new Wanna_isp_coverage_check_Plugin();

?>
