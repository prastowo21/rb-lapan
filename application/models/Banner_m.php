<?php 

class Banner_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'banner';		// nama table
		$this->data['primary_key']	= 'id_banner';	// kolom primary key
	}
}

/* End of file Banner_m.php */
/* Location: ./application/model/Banner_m.php */
?>