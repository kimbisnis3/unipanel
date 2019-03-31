<?php

class Auth extends CI_Controller{

    function __construct(){
        parent::__construct();
        
        $this->load->model('Unimodel');

    }

    function index(){
        $this->load->view('auth/v_auth');
    }

    function auth_process(){
        $username = $this->input->post('username');
        $password = $this->input->post('pass');
        $where = array(
            'aktif'     => '1',
            'username'  => $username,
            'password'  => $password,
            );
        $cek = $this->Unimodel->cek_auth("t_user",$where)->num_rows();
        if($cek > 0){
            $session_kode = array(
                'lastlogin' => 'now()' 
            );
            $wheresession = array(
                'username' => $username,
            );
            $this->Unimodel->sessionkodeup($wheresession, $session_kode);
            $result = $this->Unimodel->datauser($username);
            $data_session = array(
                'username'  => $username,
                'status'    => "online",
                'in'        => TRUE,
                'id'        => $result->id,
                'nama'      => $result->nama,
                'alamat'    => $result->alamat,
            );

            $this->session->set_userdata($data_session);
            $this->db->trans_complete();
            $r['sukses'] = 'success' ;
            echo json_encode($r);

        }else{
            $r['sukses'] = 'fail' ;
            echo json_encode($r);
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}
