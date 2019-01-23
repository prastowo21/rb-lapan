<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//nama class harus sama dengan nama file dan diawali dengan huruf besar
class Berita extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('pageview_m');
        $this->load->model('berita_m');

        $year  = date("Y");
        $month = date("m");
        $day   = date("d");

        date_default_timezone_set('Asia/Jakarta');

        $this->data['Berita'] = $this->berita_m->get_by_order('tanggal_berita', 'DESC', array('status' => 1));

        $this->data['totalvisitorday'] = $this->pageview_m->affected_rows(array('day' => $day, 'month' => $month, 'year' => $year));

        $this->data['totalvisitor'] = $this->pageview_m->affected_rows();
    }

    
    public function view(){
        $this->load->model('user_m');
        $this->load->model('admin_m');
        $this->load->model('editor_m');
        $this->load->model('komentar_m');

        $judul_berita  = $this->uri->segment(3);

        $this->data['id_berita'] = $this->berita_m->get_row(array('slug' => $judul_berita))->id_berita;
        $this->data['Komentar'] = $this->komentar_m->get_by_order('id_berita', 'ASC', array('id_berita' => $this->data['id_berita']));
        $this->data['berita'] = $this->berita_m->get_row(array('slug' => $judul_berita));

        $id_role = $this->user_m->get_row(array('id_user' => $this->berita_m->get_row(array('slug' => $judul_berita))->id_user))->id_role;

        if ($id_role == 1){
			$this->data['penulis'] = $this->admin_m->get_row(array('id_user' => $this->berita_m->get_row(array('slug' => $judul_berita))->id_user))->nama;
		} elseif ($id_role == 2){
		 	$this->data['penulis'] = $this->editor_m->get_row(array('id_user' => $this->berita_m->get_row(array('slug' => $judul_berita))->id_user))->nama;
		}

        $this->data['title']    = $this->title;
        $this->data['content']  = 'berita';
        $this->template($this->data);
    }

    public function komentar_management(){
        $this->load->model('komentar_m');

        $this->data['Komentar'] = $this->komentar_m->get();

        date_default_timezone_set('Asia/Jakarta');
        if ($this->POST('tambah')) {
                $data = array(
                    'id_berita'         => $this->POST('id_berita'),
                    'nama'              => $this->POST('nama'),
                    'komentar'          => $this->POST('komentar'),
                    'email'             => $this->POST('email'),
                    'tanggal'           => date("Y-m-d H:i:s", time())
                );
                
                $this->komentar_m->insert($data);
                redirect('berita/view/'.url_title($this->POST('judul'), '-', TRUE));
                exit;
            
        }
        $this->data['title']    = $this->title;
        $this->data['content']  = 'berita';
        $this->template($this->data);      
    }
}

?>
