<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notfound extends CI_Controller {

function __construct() {
    parent::__construct();
     date_default_timezone_set('Asia/Makassar');
     $this->session->set_userdata('referred_from', current_url()); 
         

   
}
 function index(){
    
    $this->load->view('404');
      
}
}