<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//nama class harus sama dengan nama file dan diawali dengan huruf besar
class Menu extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pageview_m');
        $this->load->library(array('recaptcha','form_validation'));
        date_default_timezone_set('Asia/Jakarta');

        $year  = date("Y");
        $month = date("m");
        $day   = date("d");

        $this->data['totalvisitorday'] = $this->pageview_m->affected_rows(array('day' => $day, 'month' => $month, 'year' => $year));

        $this->data['totalvisitor'] = $this->pageview_m->affected_rows();
    }

    public function visimisi(){
        $this->load->model('menu_vimi_m');

        $this->data['vimis'] = $this->menu_vimi_m->get();

    	$this->data['title']	= $this->title;
		$this->data['content']	= 'visi_misi';
		$this->template($this->data);
    }

    public function tujuan(){
        $this->load->model('menu_tujuan_m');

        $this->data['tujuans'] = $this->menu_tujuan_m->get();

    	$this->data['title']	= $this->title;
		$this->data['content']	= 'tujuan';
		$this->template($this->data);
    }

    public function sasaran(){
        $this->load->model('menu_sasaran_m');

        $this->data['sasarans'] = $this->menu_sasaran_m->get();

    	$this->data['title']	= $this->title;
		$this->data['content']	= 'sasaran';
		$this->template($this->data);
    }

    // public function peraturan_rb(){
    //     $this->load->model('menu_peraturan_rb_m');

    //     $this->data['Peraturan_rb'] = $this->menu_peraturan_rb_m->get();

    //     $this->data['title']    = $this->title;
    //     $this->data['content']  = 'peraturan_rb';
    //     $this->template($this->data);
    // }

    public function quickwin(){
        $this->load->model('menu_quickwin_m');

        $this->data['quickwins'] = $this->menu_quickwin_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'quickwin';
        $this->template($this->data);
    }

    public function kebijakan(){
        $this->load->model('menu_kebijakan_m');

        $this->data['Kebijakan'] = $this->menu_kebijakan_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'kebijakan';
        $this->template($this->data);
    }

    public function buletin(){
        $this->load->model('menu_buletin_m');

        $this->data['Buletin'] = $this->menu_buletin_m->get_by_order('tahun', 'DESC');

        $this->data['title']    = $this->title;
        $this->data['content']  = 'buletin';
        $this->template($this->data);
    }

    public function roadmap(){
        $this->load->model('menu_roadmap_m');

        $this->data['Roadmap'] = $this->menu_roadmap_m->get_by_order('id_roadmap', 'DESC');
        $this->data['namafile'] = $this->menu_roadmap_m->get_by_order('id_roadmap', 'DESC');

        $this->data['title']    = $this->title;
        $this->data['content']  = 'roadmap';
        $this->template($this->data);   
    }

    public function monev(){
        $this->load->model('menu_monev_m');

        $this->data['Monev'] = $this->menu_monev_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'monev';
        $this->template($this->data);
    }

    public function ikm(){
        $this->load->model('menu_ikm_m');

        $this->data['IKM'] = $this->menu_ikm_m->get_by_order('title', 'DESC');

        $this->data['title']    = $this->title;
        $this->data['content']  = 'ikm';
        $this->template($this->data);
    }
    public function api_ikm(){
        $this->load->model('menu_ikm_m');

        $this->data['IKM'] = $this->menu_ikm_m->get_by_order('title', 'DESC');

        $this->data['title']    = $this->title;
        $this->data['content']  = 'ikm';
       echo json_encode($this->data['IKM']);
    }
    public function getResponseCaptcha($str)
    {
        $this->load->library('recaptcha');
        $response = $this->recaptcha->verifyResponse($str);
        if ($response['success'])
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('getResponseCaptcha', '%s is required.' );
            return false;
        }
    }

    public function ipk(){
        $this->load->model('menu_ipk_responden');
        $this->load->model('menu_ipk_kuisioner');

        $this->data['ipk_total'] = $this->menu_ipk_kuisioner->get_ipk();
        $this->data['recaptcha_html'] = $this->recaptcha->render();

        if($this->POST('submit'))
        {
            $id_responden = $this->menu_ipk_responden->get_id_auto('id_responden',1);

            $this->form_validation->set_rules('nama', 'nama', 'required');
            $this->form_validation->set_rules('jabatan', 'jabatan', 'required');
            $this->form_validation->set_rules('nama_instansi', 'nama_instansi', 'required');
            $this->form_validation->set_rules('alm_instansi', 'alm_instansi', 'required');
            $this->form_validation->set_rules('tlp_instansi', 'tlp_instansi', 'required');
            $this->form_validation->set_rules('kota', 'kota', 'required');
            $this->form_validation->set_rules('1a', 'Pertanyaan 1a', 'required');
            $this->form_validation->set_rules('1b', 'Pertanyaan 1b', 'required');
            $this->form_validation->set_rules('1c', 'Pertanyaan 1c', 'required');
            $this->form_validation->set_rules('1d', 'Pertanyaan 1d', 'required');
            $this->form_validation->set_rules('1e', 'Pertanyaan 1e', 'required');
            $this->form_validation->set_rules('1f', 'Pertanyaan 1f', 'required');
            $this->form_validation->set_rules('1g', 'Pertanyaan 1g', 'required');
            $this->form_validation->set_rules('3a', 'Pertanyaan 3a', 'required');
            $this->form_validation->set_rules('3b', 'Pertanyaan 3b', 'required');
            $this->form_validation->set_rules('3c', 'Pertanyaan 3c', 'required');
            $this->form_validation->set_rules('3d', 'Pertanyaan 3d', 'required');
            $this->form_validation->set_rules('4a', 'Pertanyaan 4a', 'required');
            $this->form_validation->set_rules('4b', 'Pertanyaan 4b', 'required');
            $this->form_validation->set_rules('4c', 'Pertanyaan 4c', 'required');
            $this->form_validation->set_rules('4d', 'Pertanyaan 4d', 'required');
            $this->form_validation->set_rules('q1', 'Pertanyaan q1', 'required');
            $this->form_validation->set_rules('q2', 'Pertanyaan q2', 'required');
            $this->form_validation->set_rules('q3', 'Pertanyaan q3', 'required');
            $this->form_validation->set_rules('q4', 'Pertanyaan q4', 'required');
            $this->form_validation->set_rules('q5', 'Pertanyaan q5', 'required');
            $this->form_validation->set_rules('q6', 'Pertanyaan q6', 'required');
            $this->form_validation->set_rules('q7', 'Pertanyaan q7', 'required');

            $this->form_validation->set_rules('g-recaptcha-response', '<strong>Captcha</strong>', 'callback_getResponseCaptcha');
            $this->form_validation->set_message('required', '{field} is required.');
            $this->form_validation->set_message('callback_getResponseCaptcha', '{field} {g-recaptcha-response} harus diisi. ');

            if($this->form_validation->run() == TRUE)
            {
                $data_responden = array(
                    'id_responden'  => $id_responden,
                    'nama'          => $this->POST('nama'),
                    'jabatan'       => $this->POST('jabatan'),
                    'nama_instansi' => $this->POST('nama_instansi'),
                    'alm_instansi'  => $this->POST('alm_instansi'),
                    'tlp_instansi'  => $this->POST('tlp_instansi'),
                    'kota'          => $this->POST('kota'),
                    'tanggal'       => date("Y-m-d H:i:s"),
                    'status'        => 0
                );
                $this->menu_ipk_responden->insert($data_responden);

                foreach ($this->POST('2q') as $value) {
                    //$arr["2q"] = $value;
                    $save_data = array(
                        'id_responden'   => $id_responden,
                        'id_pertanyaan'  => '2q',
                        'jawaban'       => $value,
                        'tanggal'       => date("Y-m-d H:i:s"),
                        'status'        => 1
                    );
                    $this->menu_ipk_kuisioner->insert($save_data);
                }

                $data_kuisioner = array(
                    '1a'            => $this->POST('1a'),
                    '1b'            => $this->POST('1b'),
                    '1c'            => $this->POST('1c'),
                    '1d'            => $this->POST('1d'),
                    '1e'            => $this->POST('1e'),
                    '1f'            => $this->POST('1f'),
                    '1g'            => $this->POST('1g'),
                    '3a'            => $this->POST('3a'),
                    '3b'            => $this->POST('3b'),
                    '3c'            => $this->POST('3c'),
                    '3d'            => $this->POST('3d'),
                    '4a'            => $this->POST('4a'),
                    '4b'            => $this->POST('4b'),
                    '4c'            => $this->POST('4c'),
                    '4d'            => $this->POST('4d'),
                    'q1'            => $this->POST('q1'),
                    'q2'            => $this->POST('q2'),
                    'q3'            => $this->POST('q3'),
                    'q4'            => $this->POST('q4'),
                    'q5'            => $this->POST('q5'),
                    'q6'            => $this->POST('q6'),
                    'q7'            => $this->POST('q7')
                );

                foreach ($data_kuisioner as $key => $value) {
                    $save_data = array(
                        'id_responden'  => $id_responden,
                        'id_pertanyaan' => $key,
                        'jawaban'       => $value,
                        'tanggal'       => date("Y-m-d H:i:s"),
                        'status'        => 1
                    );
                    $this->menu_ipk_kuisioner->insert($save_data);
                    
                }
                    $this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
                    redirect('menu/ipk');
            }else{
                $this->flashmsg('<i class="fa fa-warning"></i> Harap mengisi Captcha dengan benar', 'danger');
                $this->form_validation->set_message('required', '{field} is required.');
                $this->form_validation->set_message('callback_getResponseCaptcha', '{field} {g-recaptcha-response} harus diisi. ');
                redirect('menu/ipk');
            }

            
        }

        $this->data['title']    = $this->title;
        $this->data['content']  = 'ipk';
        $this->template($this->data);
    }

    public function manajemen_perubahan(){
        $this->load->model('menu_manajemen_perubahan_m');

        $this->data['Manajemen_perubahan'] = $this->menu_manajemen_perubahan_m->get();
        

        $this->data['title']    = $this->title;
        $this->data['content']  = 'manajemen_perubahan';
        $this->template($this->data);
    }

    public function penataan_peraturan_uu(){
        $this->load->model('menu_penataan_peraturan_uu_m');

        $this->data['Penataan_peraturan_uu'] = $this->menu_penataan_peraturan_uu_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'penataan_peraturan_uu';
        $this->template($this->data);
    }

    public function penataan_dan_penguatan_organisasi(){
        $this->load->model('menu_penataan_dan_penguatan_organisasi_m');

        $this->data['Penataan_dan_penguatan_organisasi'] = $this->menu_penataan_dan_penguatan_organisasi_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'penataan_dan_penguatan_organisasi';
        $this->template($this->data);
    }

    public function penataan_tatalaksana(){
        $this->load->model('menu_penataan_tatalaksana_m');

        $this->data['Penataan_tatalaksana'] = $this->menu_penataan_tatalaksana_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'penataan_tatalaksana';
        $this->template($this->data);
    }

    public function penataan_sistem_manajemen_sdm(){
        $this->load->model('menu_penataan_sistem_manajemen_sdm_m');

        $this->data['Penataan_sistem_manajemen_sdm'] = $this->menu_penataan_sistem_manajemen_sdm_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'penataan_sistem_manajemen_sdm';
        $this->template($this->data);
    }

    public function penguatan_pengawasan(){
        $this->load->model('menu_penguatan_pengawasan_m');

        $this->data['Penguatan_pengawasan'] = $this->menu_penguatan_pengawasan_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'penguatan_pengawasan';
        $this->template($this->data);
    }

    public function penguatan_akuntabilitas_kinerja(){
        $this->load->model('menu_penguatan_akuntabilitas_kinerja_m');

        $this->data['Penguatan_akuntabilitas_kinerja'] = $this->menu_penguatan_akuntabilitas_kinerja_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'penguatan_akuntabilitas_kinerja';
        $this->template($this->data);
    }

    public function peningkatan_kualitas_pelayanan_publik(){
        $this->load->model('menu_peningkatan_kualitas_pelayanan_publik_m');

        $this->data['Peningkatan_kualitas_pelayanan_publik'] = $this->menu_peningkatan_kualitas_pelayanan_publik_m->get();

        $this->data['title']    = $this->title;
        $this->data['content']  = 'peningkatan_kualitas_pelayanan_publik';
        $this->template($this->data);
    }

    public function generateTicket()
    {
           $ticket= get_trusted_ticket_direct($_POST['server'], $_POST['user'], $_POST['targetsite']);
           echo $ticket;
           print_r($ticket);
           exit;
    }

    public function getTicketTableau(){
        if ($_POST['toDo'] == 'generateTicket') {
            generateTicket();
        }    
    }   
}
