<?php
/*
Plugin Name: Form Plugin
Plugin URI:
Description: Traking form  Demo
Version: 1.0
Author: robin
Author URI: 
License: 
Text Domain: tackingform
Domain Path: /languages/

*/

/*add_action( 'wo_enqueue_scripts', function ( $hook ) {
  if ( "toplevel_page_dbdemo" == $hook ) {
    wp_enqueue_style( 'dbdemo-style', plugin_dir_url( __FILE__ ) . 'assets/css/form.css' );
  }
} );

*/
class AssetsNinja {

  private $version;

  function __construct() {

    $this->version = time();


    add_action( 'plugins_loaded', array( $this, 'tackingform_load_textdomain' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'load_front_assets' ) );
    add_shortcode('example_form',array($this,'example_form_plugin'));
  }

function load_front_assets() {
  if(is_page('12-2')){ // for dev it will be changed
   wp_enqueue_style( 'form-style', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.css', null, $this->version );
  }
 }
//wp_enqueue_style( 'form-style', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.css' );



function tackingform_load_textdomain(){
  load_plugin_textdomain('trackingform', false, dirname(__FILE__)."/languages");
}


function example_form_plugin(){
	$content = '';
	$content .= '<div class="container-fluid" >
      <div class="row col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h4>Tracking Form</h4>
          </div>
          <div class="panel-body">
            <form action=" '.plugin_dir_url(__FILE__) . 'connect.php'.' " method="post">
              <div class="form-group">
                <label for="he">Housing & Electricity</label>
                <input
                  type="number"
                  step = "any"
                  class="form-control"
                  id="he"
                  name="he"
                />
              </div>
              <div class="form-group">
                <label for="tt">Transportation & Travel</label>
                <input
                  type="number"
                  step = "any"
                  class="form-control"
                  id="tt"
                  name="tt"
                />
              </div>
              
              <div class="form-group">
                <label for="food">Food</label>
                <input
                  type="number"
                  step = "any"
                  class="form-control"
                  id="food"
                  name="food"
                />
              </div>
             <div class="form-group">
                <label for="mc">Miscellaneous Consumption</label>
                <input
                  type="number"
                  step = "any"
                  class="form-control"
                  id="mc"
                  name="mc"
                />
              </div>
              <div class="form-group">
                <label for="pc">Public Consumption</label>
                <input
                  type="number"
                  step = "any"
                  class="form-control"
                  id="pc"
                  name="pc"
                />
              </div>
              <div class="form-group">
                <label for="month">Month</label>
                <input
                  type="number"
                  class="form-control"
                  id="month"
                  name="month"
                />
              </div>
              <div class="form-group">
                <label for="year">Year</label>
                <input
                  type="number"
                  class="form-control"
                  id="year"
                  name="year"
                />
              </div>
              <input type="submit" class="btn btn-primary" />
            </form>
          </div>
          <div class="panel-footer text-right">
            <small>&copy;Climateactivity</small>
          </div>
        </div>
      </div>
    </div>';
	return $content;
  }
}
//shortcode will be [example_form/]



new AssetsNinja();


