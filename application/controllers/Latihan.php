<?php
/*
-- ---------------------------------------------------------------
=== JUA KOPI ===
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Latihan extends CI_Controller {
	 public function __construct() {
        parent::__construct();
        $id = decode($this->session->id_siswa);
        $siswa = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $cabang  = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        
        if($cabang['status'] == 'sekolah'){
            cek_session();
        }else{
            exit();
        }

    }
    function index(){
        $id = decode($this->session->id_siswa);
       
        $data['title'] = 'Latihan - '.title();
        update_session($id,date('Y-m-d'));
			$this->template->load('phpmu-tigo/template-latihan','phpmu-tigo/view_latihan',$data);
    }
    function getSoal(){
		$quiz_id = decode($this->input->post('id'));
	
		$id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
		$cek = $this->model_app->view_where('quiz',array('id_quiz'=>$quiz_id));
		$soal = null;
		$answer_a = null;
		$answer_b = null;
		$answer_c = null;
		$answer_d = null;
		$title  = null;
		$row = null;
		$button = null;
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
            $map= $this->model_app->view_Where("mata_pelajaran",array('mapel_id'=>$row['mapel_id']))->row_array();
            $mapel = $map['mapel'];
            $kelas = $row['kelas'];
			$qa = $this->model_app->view_where('quiz',array('id_quiz'=>$row['id_quiz']))->row_array();
			
			if($qa['image'] != NULL   ){
				$img = "<div class='col-6 mt-2'><img src='".$qa['image']."' class='img-fluid'></div>";
			}else{
				$img = "";
			}
			
			$button = "<div class='col-6'></div><div class='col-6'><button id='btnAnswer' class='btn btn-outline-primary w-100'><ion-icon name='save-outline'></ion-icon> JAWAB</button></div>"; 

			$soal = $img."<div class='col-12 my-3'><h4 class='text-center text-white '>".str_replace(array('<p>','</p>'),'',$qa['quiz'])."</h4></div>";
			$answer_a = str_replace(array('<p>','</p>'),'',$qa['answer_a']);
			$answer_b = str_replace(array('<p>','</p>'),'',$qa['answer_b']);
			$answer_c = str_replace(array('<p>','</p>'),'',$qa['answer_c']);
			$answer_d = str_replace(array('<p>','</p>'),'',$qa['answer_d']);
			// $title = $row['qa_soal'].' / '.$this->model_app->view_where('quiz_answer',array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa))->num_rows();


			$status = true;
		}else{
			$status = false;
		}
		$arr = array('status'=>$status,'answer_a'=>$answer_a,'answer_b'=>$answer_b,'answer_c'=>$answer_c,'answer_d'=>$answer_d,'soal'=>$soal,'mapel'=>$mapel,'kelas'=>$kelas,'button'=>$button);
		echo json_encode($arr);
	}
    function saveAnswer(){
	
        $id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
        update_session($id_siswa,date('Y-m-d'));
		
		$ql_id = decode($this->input->post('ql_id'));
		$id_quiz = $this->input->post('id_quiz');
		
		$answer = $this->input->post('answer');
		$row = $this->model_app->view_where('quiz_latihan',array('ql_id'=>$ql_id))->row_array();
		if($row['ql_keys'] == $answer){
			$conn = 'benar';
			$status = true;
			$message = 'Selamat jawaban anda benar';

		}else{
			$rowQ = $this->model_app->view_where('quiz',array('id_quiz'=>$row['id_quiz']))->row_array();
			$status = false;
			$message = "<h6 class='d-block my-2 text-center'>Maaf jawaban anda salah</h6><center><img src='".base_url('asset/images/iconic.png')."' class='img-fluid my-2' style='height:120px;width:80px'></center>";
			$message .= "<span class='d-block text-center'>".str_replace(array('<p>','</p>'),'',$rowQ['correction'])."</span>";
            $conn= 'salah';
		}
		
		$dataQA = array('ql_answer'=>$answer,'ql_status'=>$conn);
		$this->model_app->update('quiz_latihan',$dataQA,array('ql_id'=>$ql_id));
		echo json_encode(array('status'=>$status,'msg'=>$message));
	}
    function next(){
		$id = decode($this->session->id_siswa);
		$mapel = decode($this->input->post('mapel'));
		$siswa = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $getSoal= $this->db->query("SELECT * FROM quiz WHERE kelas = '".$siswa['kelas']."' AND mapel_id = '".$mapel."' ORDER BY RAND() LIMIT 1")->row_array();
        $data = array('ql_id_quiz'=>$getSoal['id_quiz'],'ql_id_siswa'=>$id,'ql_keys'=>$getSoal['answer']);
        $ql_id = $this->model_app->insert_id('quiz_latihan',$data);
        $ql_id = encode($ql_id);
        $id_quiz= encode($getSoal['id_quiz']);
        echo json_encode(array('ql_id'=>$ql_id,'id_quiz'=>$id_quiz));
    }
	function generateSoal(){
		$id = decode($this->session->id_siswa);
		$mapel = decode($this->input->post('mapel'));
		$siswa = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $getSoal= $this->db->query("SELECT * FROM quiz WHERE kelas = '".$siswa['kelas']."' AND mapel_id = '".$mapel."' ORDER BY RAND() LIMIT 1")->row_array();
        $data = array('ql_id_quiz'=>$getSoal['id_quiz'],'ql_id_siswa'=>$id,'ql_keys'=>$getSoal['answer']);
        $ql_id = $this->model_app->insert_id('quiz_latihan',$data);
        $ql_id = encode($ql_id);
        $id_quiz= encode($getSoal['id_quiz']);
        echo json_encode(array('ql_id'=>$ql_id,'id_quiz'=>$id_quiz));
	}
}