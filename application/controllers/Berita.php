<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita extends CI_Controller {
    
    public $table       = 'm_berita';
    public $judul       = 'Berita';
    public $aktifgrup   = 'berita';
    public $aktifmenu   = 'berita';
    public $foldername  = 'berita';
    public $indexpage   = 'berita/v_berita';
    function __construct() {
        parent::__construct();
        include(APPPATH.'libraries/sessionakses.php');
        $title      = $this->judul;
    }
    public function index(){
        $data['title']      = $this->judul;
        $data['aktifgrup']  = $this->aktifgrup;
        $data['aktifmenu']  = $this->aktifmenu;
        $title      = $this->judul;
        $this->load->view($this->indexpage, $data);  
    }

    public function setView(){
        $result     = $this->Unimodel->getdata($this->table);
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {
            ($r->image == NULL ) ? $gambar = "(Noimage)" : $gambar = "<img style='max-width : 30px;' src='.".$r->image."'>";
            $row    = array(
                        "no"        => $no,
                        "kode"      => $r->kode,
                        "judul"     => $r->judul,
                        "subjudul"  => $r->subjudul,
                        "artikel"   => $r->artikel,
                        "image"     => $gambar,
                        "ket"       => $r->ket,
                        "aktif"     => aktif($r->aktif),
                        "action"    => btnuda($r->id)
                        
            );
            $list[] = $row;
            $no++;
        }   
        echo json_encode(array('data' => $list));
    }

    public function tambah()
    {
        $d['useri']     = $this->session->userdata('nama');
        $d['judul']     = $this->input->post('judul');
        $d['artikel']   = $this->input->post('artikel');
        $d['ket']       = $this->input->post('ket');
        $d['slug']      = slug($this->input->post('judul'));

        $insert = $this->Unimodel->save($this->table,$d);

        $r['sukses'] = ($insert > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    public function tambahfile()
    {   
        $config['upload_path'] = './uploads/'.$this->foldername;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = '*';
        $config['file_name'] = slug($this->input->post('judul'));
        $path = substr($config['upload_path'],1);
        $this->upload->initialize($config);
        
        if ( ! $this->upload->do_upload('image')){
            $d['useri']     = $this->session->userdata('username');
            $d['judul']     = $this->input->post('judul');
            $d['artikel']   = $this->input->post('artikel');
            $d['ket']       = $this->input->post('ket');
            $d['slug']      = slug($this->input->post('judul'));
            $insert = $this->Unimodel->save($this->table,$d);
        }else{
            $d['useri']     = $this->session->userdata('username');
            $d['judul']     = $this->input->post('judul');
            $d['artikel']   = $this->input->post('artikel');
            $d['ket']       = $this->input->post('ket');
            $d['slug']      = slug($this->input->post('judul'));
            $d['image']    = $path.'/'.$this->upload->data('file_name');
           
            $insert = $this->Unimodel->save($this->table,$d);
        }
        $r['sukses'] = ($insert > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    public function edit()
    {
        $w['id'] = $this->input->post('id');
        $data = $this->Unimodel->edit($this->table,$w);
        echo json_encode($data);
    }
    public function update()
    {
        $d['useri']     = $this->session->userdata('username');
        $d['judul']     = $this->input->post('judul');
        $d['artikel']   = $this->input->post('artikel');
        $d['ket']       = $this->input->post('ket');
        $d['slug']      = slug($this->input->post('judul'));

        $w['id'] = $this->input->post('id');
        $update = $this->Unimodel->update($this->table,$d,$w);
        $r['sukses'] = ($update > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    function updatefile(){
        $config['upload_path'] = './uploads/'.$this->foldername;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = '*';
        $config['file_name'] = slug($this->input->post('judul'));
        $path =  substr($config['upload_path'],1);
        $this->upload->initialize($config);
        $pathfile   = $this->input->post('path');
        $ext        = substr($pathfile, -3);
        if ( ! $this->upload->do_upload('image')){
        
                @rename("$pathfile",'.'.$path.'/'.$this->upload->data('file_name').'.'.$ext);
                
                $d['useru']     = $this->session->userdata('username');

                $d['judul']     = $this->input->post('judul');
                $d['artikel']   = $this->input->post('artikel');
                $d['ket']       = $this->input->post('ket');
                $d['slug']      = slug($this->input->post('judul'));
                $d['image']     = $path.'/'.$this->upload->data('file_name').'.'.$ext ;

                $w['id'] = $this->input->post('id');
                $update = $this->Unimodel->update($this->table,$d,$w);
        }else{
                @unlink("$pathfile");
                $d['useru']     = $this->session->userdata('username');
                $d['judul']     = $this->input->post('judul');
                $d['artikel']   = $this->input->post('artikel');
                $d['ket']       = $this->input->post('ket');
                $d['slug']      = slug($this->input->post('judul'));
                $d['image']     = $path.'/'.$this->upload->data('file_name');

                $w['id'] = $this->input->post('id');
                $update = $this->Unimodel->update($this->table,$d,$w);
        }
        $r['sukses'] = ($update > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    public function hapus()
    {
        $w['id'] = $this->input->post('id');
        $sql = "SELECT image FROM {$this->table} WHERE id = {$this->input->post('id')}";
        $path = $this->db->query($sql)->row()->image;
        
        @unlink('.'.$path);
        
        $w['id'] = $this->input->post('id');
        $delete = $this->Unimodel->delete($this->table,$w);
        $r['sukses'] = ($delete > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    public function aktif()
    {
        $sql = "SELECT aktif FROM {$this->table} WHERE id = {$this->input->post('id')}";
        $s = $this->db->query($sql)->row()->aktif;

        $s == 1 ? $status = 0 : $status =1;

        $d['aktif'] = $status;
        $w['id'] = $this->input->post('id');   
        $update = $this->Unimodel->update($this->table,$d,$w);
        $r['sukses'] = ($update > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    
}