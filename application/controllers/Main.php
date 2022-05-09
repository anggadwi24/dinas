<?php
/*
-- ---------------------------------------------------------------
=== JUA KOPI ===
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	 public function __construct() {
        parent::__construct();
        $id = decode($this->session->id_siswa);
        $siswa = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $cabang  = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        if($cabang['status'] == 'sekolah'){

        }else{
            exit();
        }

    }
    public function index()
    {
        cek_session();
        $data['title']= 'Home - '.title();
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        update_session($id,date('Y-m-d'));
        $data['row'] = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $this->template->load('phpmu-tigo/template','phpmu-tigo/view_home',$data);

    }
    function startKuis(){
        cek_session();
        $id = $this->session->id_siswa;
        $id_siswa = $this->encrypt->decode($id,keys());
        $me = $this->model_app->view_where('siswa',array('id_siswa'=>$id_siswa))->row_array();
        $tgl = date('Y-m-d');
        $cek = $this->model_app->view_where('quiz_date',array('tanggal'=>$tgl,'kelas'=>$me['kelas']));
        $status = null;
        if($cek->num_rows() >0 ){
            
            $row = $cek->row_array();
            if($row['start'] <= date('H:i:s')){
                if($row['end'] >= date('H:i:s')){
                    $status =true;
                    $cekQ = $this->model_app->view_where('quiz_partisipasi',array('qp_date'=>$row['id_qd'],'id_siswa'=>$id_siswa));
                    if($cekQ->num_rows() > 0){
                        $rowQ = $cekQ->row_array();
                        if($rowQ['qp_done'] == 'y'){
                            $access = 'n';
                            $message = 'Kuis Sudah Selesai';
                        }else{
                            $id_qp = $this->session->encode($rowQ['id_qp'],keys());
                            
                            $access = 'y';
                            $message = base_url('kuis/getKuis?id='.$id_qp);
                        
                        }
                    }else{
                        $data = array('id_siswa'=>$id_siswa,'qp_date'=>$row['id_qd'],'quiz_duration'=>'120:00');
                        $id_qp = $this->model_app->insert_id('quiz_partisipasi',$data);
                        $soal = $this->db->query("SELECT * FROM `quiz` WHERE status = 'y' AND kelas='".$me['kelas']."' AND mapel_id = '".$row['mapel_id']."' ORDER BY RAND() LIMIT 50");
                        $no = 1;
                        foreach($soal->result_array() as $s)
                        {	
                            $dataqu = array('id_qp'=>$id_qp,
                                            'id_quiz'=>$s['id_quiz'],
                                            'id_siswa'=>$id_siswa,
                                            'qa_keys'=>$s['answer'],
                                            'qa_soal'=>$no,
                                        );

                            $this->model_app->insert('quiz_answer',$dataqu);
                            $no++;
                        }
                        $id_qpp = $this->encrypt->encode($id_qp,keys());
                        $access = 'y';
                        $message = base_url('kuis/getKuis?id='.$id_qpp);

                    }
                }else{
                    $access = 'n';
                    $message = 'Sesi Kuis Sudah Selesai';
                }
            }else{
                $access = 'n';
                $message = 'Sesi Kuis Dimulai Jam '.date('H:i',strtotime($row['start']));
            }
        }else{
            $status = false;
        }
        $arr = array('status'=>$status,'access'=>$access,'message'=>$message);
        echo json_encode($arr);
    }
   
    function cekKuisToday(){
        cek_session();
        $tgl = date('Y-m-d');
        $id= $this->session->id_siswa;
        $id_siswa= $this->encrypt->decode($id,keys());
        $siswa = $this->model_app->view_where('siswa',array('id_siswa'=>$id_siswa))->row_array();;
        $cek = $this->model_app->view_where('quiz_date',array('tanggal'=>$tgl,'kelas'=>$siswa['kelas']));
        $access = null;
        $status = null;
        $id_qp = null;
        if($cek->num_rows() >0 ){
            $status =  true;
            $row = $cek->row_array();
            if($row['status'] == 'y'){
                if($row['start'] <= date('H:i:s')){
                    if($row['end'] >= date('H:i:s')){
                        $cekQ = $this->model_app->view_where('quiz_partisipasi',array('qp_date'=>$row['id_qd'],'id_siswa'=>$id_siswa));
                        if($cekQ->num_rows() > 0){
                            $rowQ = $cekQ->row_array();
                            if($rowQ['qp_done'] == 'y'){
                                $access ='f';
                            }else{
                                $access = 'p';
                                $id_qp = $this->encrypt->encode($rowQ['id_qp'],keys());
                            }
                        }else{
                            $access ='y';
                        }
                    }else{
                        $access = 'd';
                    }
                   
                }else{
                    $access = 's';
                }
               
                
                
            }else{
                $access = 'n';
            }
        }else{
            $status = false;
        }
        $arr = array('status'=>$status,'access'=>$access,'id_qp'=>$id_qp);
        echo json_encode($arr);
    }
}
