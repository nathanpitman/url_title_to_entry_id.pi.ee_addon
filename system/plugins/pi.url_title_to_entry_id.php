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
 * Pull the Entry ID for a given URL Title.
 *
 * @package		ExpressionEngine
 * @category		Plugin
 * @author		Nine Four
 * @copyright		Copyright (c) 2010, Nine Four Ltd
 * @link		http://ninefour.co.uk/labs/
 */

class Url_title_to_entry_id {
	function Url_title_to_entry_id() {
		$this->EE =& get_instance();
		$url_title = $this->EE->TMPL->fetch_param('url_title');
		$channel = $this->EE->TMPL->fetch_param('channel');
		$errors = $this->EE->TMPL->fetch_param('errors', 'true');

		if (!empty($channel)) {
			// get channel id from specified short name
			$this->EE->db->select('channel_id')
				->from('channels')
				->where('channel_name', $channel)
				->limit(1);
			$query = $this->EE->db->get();
			$channel_id = $query->row('channel_id');

			if (!empty($url_title) && !empty($channel_id)) {
				$where_array = array(
					'url_title'	=>$url_title,
					'channel_id'=>$channel_id
				);

				$this->EE->db->select('entry_id')
					->from('channel_titles')
					->where($where_array)
					->limit(1);
				$query = $this->EE->db->get();

				if ($query->num_rows() == 0) {
					if ($errors == 'false') {
						$this->return_data = '';
					} else {
						$this->return_data = 'No matching channel entry found';
					}
				} else {
					$this->return_data = $query->row('entry_id');
				}
			} else {
				if ($errors == 'false') {
					$this->return_data = '';
				} else {
					$this->return_data = 'No url_title specified or bad channel name';
				}
			}

		} else {
			if ($errors == 'false') {
				$this->return_data = '';
			} else {
				$this->return_data = 'No channel specified';
			}
		}
		
	}

	function usage() {
		ob_start();
		?>
The URL title to entry ID Plugin simply returns the corresponding entry ID for a given URL title in a specified channel.

{exp:url_title_to_entry_id url_title="{segment_2}" channel="channel_short_name"}

Just specify the channel short name and URL title you wish to return an entry ID for as parameters and away you go. Simples.
		<?php
		return ob_get_clean();
	}
	// END
}

/* End of file pi.url_title_to_entry_id.php */
/* Location: ./system/expressionengine/third_party/url_title_to_entry_id/pi.url_title_to_entry_id.php */