<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Api extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->methods['transaksi_get']['limit'] = 500; 
        $this->methods['transaksi_post']['limit'] = 100; 
        $this->methods['transaksi_delete']['limit'] = 50; 
        $this->methods['transaksi_put']['limit'] = 100; 
        $this->load->database();
    }

    public function transaksi_get()
    {
        $id = $this->get('id_peminjaman');
        if ($id == '') {
            $transaksi_peminjaman = $this->db->get('transaksi_peminjaman')->result();
            if ($transaksi_peminjaman)
            {
                $this->response($transaksi_peminjaman, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                    'message' => 'Data kosong'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->db->where_in('id_peminjaman', array($id));
            $transaksi_peminjaman = $this->db->get('transaksi_peminjaman')->result();
            if ($transaksi_peminjaman)
            {
                $this->response($transaksi_peminjaman, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                    'message' => 'Data tidak ada'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function transaksi_post()
    {
        $nama_mobil = $this->input->post('nama_mobil');
        $tanggal_peminjaman = $this->input->post('tanggal_peminjaman');

        $data = array(
            'nama_mobil' => $nama_mobil,
            'tanggal_peminjaman' => $tanggal_peminjaman,
            'tanggal_pengembalian' => $this->post('tanggal_pengembalian'),
            'status_peminjaman' => "Dipakai");

        $sqlxx = "SELECT * FROM transaksi_peminjaman where nama_mobil = '$nama_mobil' and tanggal_peminjaman = '$tanggal_peminjaman' and status_peminjaman = 'Dipakai'";
        $queryxx = $this->db->query($sqlxx);
        if ($queryxx->num_rows() > 0) {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Sudah ada di Database'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $insert = $this->db->insert('transaksi_peminjaman', $data);
            $data = array(
                'id_peminjaman' => $this->db->insert_id(),
                'nama_mobil' => $nama_mobil,
                'tanggal_peminjaman' => $tanggal_peminjaman,
                'tanggal_pengembalian' => $this->post('tanggal_pengembalian'),
                'status_peminjaman' => "Dipakai");
            if ($insert) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(array('status' => 'Gagal Disimpan', 502));
            }
        }

        
    }

    public function transaksi_put()
    {
        $id_peminjaman = $this->input->get('id_peminjaman');
        $tanggal_pengembalian = $this->input->get('tanggal_pengembalian');

        $sqlxx = "SELECT * FROM transaksi_peminjaman where id_peminjaman = '$id_peminjaman'";
        $queryxx = $this->db->query($sqlxx);
        if ($queryxx->num_rows() > 0) {
            $hasilxx = $queryxx->row();
            $nama_mobil = $hasilxx->nama_mobil;
            $tanggal_peminjaman = $hasilxx->tanggal_peminjaman;
        }

        if($tanggal_pengembalian < $tanggal_peminjaman){
            $this->response([
                'status' => 'Gagal Update',
                'message' => 'Tanggal pengembalian tidak boleh lebih kecil dari pada tanggal peminjaman'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $data = array(
            'id_peminjaman' => $id_peminjaman,
            'nama_mobil' => $nama_mobil,
            'tanggal_peminjaman' => $tanggal_peminjaman,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'status_peminjaman' => "Dikembalikan");
            $this->db->where('id_peminjaman', $id_peminjaman);
            $update = $this->db->update('transaksi_peminjaman', $data);
            // print_r($data); die();
            if ($update) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(array('status' => 'Gagal Update', 502));
            }
        }
    }

    function transaksi_delete()
    {

        $id = $this->input->get('id_peminjaman');
        $this->db->where('id_peminjaman', $id);
        $delete = $this->db->delete('transaksi_peminjaman');
        if ($delete) {
            $this->response(array('status' => 'Data berhasil dihapus'), 201);
        } else {
            $this->response(array('status' => 'Data gagal dihapus'), 502);
        }
    }
}
