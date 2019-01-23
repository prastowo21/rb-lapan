<?php 

class Menu_roadmap_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_roadmap';		// nama table
		$this->data['primary_key']	= 'id_roadmap';	// kolom primary key
	}
}

/* End of file Menu_roadmap_m.php */
/* Location: ./application/model/Menu_roadmap_m.php */
?>