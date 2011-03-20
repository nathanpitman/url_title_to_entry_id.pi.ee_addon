<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
  'pi_name' => 'URL title to entry ID',
  'pi_version' => '1.0',
  'pi_author' => 'Nine Four',
  'pi_author_url' => 'http://ninefour.co.uk/labs/',
  'pi_description' => 'Returns the entry ID for any specified channel URL title',
  'pi_usage' => Url_title_to_entry_id::usage()
  );

/**
 * Memberlist Class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			Nine Four
 * @copyright		Copyright (c) 2010, Nine Four Ltd
 * @link			http://ninefour.co.uk/labs/
 */

class Url_title_to_entry_id {

  function Url_title_to_entry_id()
  {
	$this->EE =& get_instance();
	$url_title = $this->EE->TMPL->fetch_param('url_title');
	$errors = $this->EE->TMPL->fetch_param('errors');
	
	if(!empty($url_title)) {
	
		$query = $this->EE->db->query("SELECT entry_id
  FROM exp_channel_titles WHERE url_title='".$url_title."' LIMIT 1");
  
  		if ($query->num_rows() == 0) {
  
			if ($errors=="false") {
			
				$this->return_data = "";
			
			} else {
			
				$this->return_data = "No matching channel entry found";
		
			}
		
		} else {
		
			$this->return_data = $query->row('entry_id');
		
		}
		
	} else {
	
		if ($errors=="false") {
			
			$this->return_data = "";
		
		} else {
		
			$this->return_data = "No url_title specified";
	
		}
	
	}
  }
  
  function usage()
  {
  ob_start(); 
  ?>
The URL title to entry ID Plugin simply returns the corresponding entry ID for a given URL title.

{exp:url_title_to_entry_id url_title="{segment_2}"}

Just specify the URL title you wish to return an entry ID for as a parameter and away you go. Simples.

  <?php
  $buffer = ob_get_contents();
	
  ob_end_clean(); 

  return $buffer;
  }
  // END
  
}

/* End of file pi.url_title_to_entry_id.php */ 
/* Location: ./system/expressionengine/third_party/url_title_to_entry_id/pi.url_title_to_entry_id.php */