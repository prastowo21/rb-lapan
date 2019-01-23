<?php 
defined('BASEPATH') || exit('No direct script allowed');

class Pengguna extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $id_role = $this->session->userdata('id_role');
        if (!isset($id_role))
        {
            redirect('login');
            exit;
        }
        $this->data['id_role'] = $id_role;
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
        exit;
    }
}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */