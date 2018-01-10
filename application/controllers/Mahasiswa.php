<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Mahasiswa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // code bellow used to show data mahasiswa
    function index_get() {
        $nim = $this->get('nim');
        if ($nim == '') {
            $mahasiswa = $this->db->get('mahasiswa')->result();
        }else {
            $this->db->where('nim', $nim);
            $mahasiswa = $this->db->get('mahasiswa')->result();
        }
        $this->response($mahasiswa,200);
    }

    // code bellow used to insert data mahasiswa
    function index_post() {
        $data = array(
            'nim'           => $this->post('nim'),
            'nama'          => $this->post('nama'),
            'jurusan_id'    => $this->post('jurusan_id'),
            'alamat'        => $this->post('alamat')
        );
        $insert = $this->db->insert('mahasiswa', $data);
        if($insert) {
            $this->response($data,200);
        }else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // code bellow used to update data mahasiswa
    function index_put() {
        $nim = $this->put('nim');
        $data = array(
            'nim'           => $this->put('nim'),
            'nama'          => $this->put('nama'),
            'jurusan_id'    => $this->put('jurusan_id'),
            'alamat'        => $this->put('alamat')
        );
        $this->db->where('nim', $nim);
        $update = $this->db->update('mahasiswa', $data);
        if($update) {
            $this->response($data, 200);
        }else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // code bellow used to delete data mahasiswa
    function index_delete() {
        $nim = $this->delete('nim');
        $this->db->where('nim', $nim);
        $delete = $this->db->delete('mahasiswa');
        if($delete) {
            $this->response(array('status' => 'success', 201));
        }else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}

?>