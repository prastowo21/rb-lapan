<?php 

class Pageview_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'pageview';		// nama table
		$this->data['primary_key']	= 'id_pageview';	// kolom primary key
	}

	
}

/* End of file Pageview_m.php */
/* Location: ./application/model/Pageview_m.php */
?>