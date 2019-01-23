<?php 

class Editor_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'editor';		// nama table
		$this->data['primary_key']	= 'id_editor';	// kolom primary key
	}

	public function getAll_IdEditor()
	{
		
		$this->db->select('id_editor');
		$query = $this->db->get($this->data['table_name']);

		return $query->result();
	}

	public function idExists($id_editor)
	{
		foreach ($this->getAll_IdEditor() as $userdata) {
			if($userdata->id_editor == $id_editor){
				return true;
			}
		}
		return false;
	}
	
}

/* End of file Editor_m.php */
/* Location: ./application/model/Editor_m.php */
?>