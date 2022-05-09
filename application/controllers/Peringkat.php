<?php
/*
-- ---------------------------------------------------------------
=== PERINGKAT =====
==== JUA KOPI =====
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Peringkat extends CI_Controller {
	public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
        $this->session->set_userdata('referred_from', current_url()); 
		// cek_session();
    }
	public function index(){
		cek_session();
        $data['title']= 'Peringkat - '.title();
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        update_session($id,date('Y-m-d'));
        $data['row'] = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $this->template->load('phpmu-tigo/template','phpmu-tigo/view_peringkat',$data);

	}
	function getRank(){
			$status = $this->input->post('status');
			$id = $this->encrypt->decode($this->session->id_siswa,keys());
			$me = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
			if($status == 'today'){
				$tgl = date('Y-m-d');
				$row = $this->model_app->view_where('quiz_date',array('tanggal'=>$tgl,'kelas'=>$me['kelas']))->row_array();
				$qp_date = $row['id_qd'];
				$rankone = $this->db->query("SELECT a.nama_lengkap,b.qp_poin,a.foto,c.nama_cabang FROM siswa a JOIN quiz_partisipasi b 
							ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd WHERE b.qp_date = '".$qp_date."'  AND a.id_sd = ".$me['id_sd']."
							GROUP BY b.id_siswa
							ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 0,1  ")->row_array();
				$ranktwo = $this->db->query("SELECT a.nama_lengkap,b.qp_poin,a.foto,c.nama_cabang FROM siswa a JOIN quiz_partisipasi b 
							ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd  WHERE b.qp_date = '".$qp_date."'  AND a.id_sd = ".$me['id_sd']."
							GROUP BY b.id_siswa
							ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 1,2  ")->row_array();
				$ranktri = $this->db->query("SELECT a.nama_lengkap,b.qp_poin,a.foto,c.nama_cabang FROM siswa a JOIN quiz_partisipasi b 
							ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd  WHERE b.qp_date = '".$qp_date."'  AND a.id_sd = ".$me['id_sd']."
							GROUP BY b.id_siswa
							ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 2,3  ")->row_array();
				$rankall = $this->db->query("SELECT a.nama_lengkap,b.qp_poin,a.foto,c.nama_cabang FROM siswa a JOIN quiz_partisipasi b 
							ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd  WHERE b.qp_date = '".$qp_date."'  AND a.id_sd = ".$me['id_sd']."
							GROUP BY b.id_siswa
							ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 3,97  ");
				$all = null;
				$rank = 4;
				foreach($rankall->result_array() as $sAll){
					$sekolah = $this->model_app->view_where('subdomain',array('id_sd'=>$sAll['id_sd']))->row_array();
					$all .= "<div class='col-12 mb-2 card-white p-1'>
					<div class='row'>
						<div class='col-1 '>
							<h3 class='pt-3'>".$rank.". </h3>
						</div>
						<div class='col-3'>
							<img src='".$sAll['foto_profle']."'  alt='' class='mr-2 img-fluid rounded-circle border' id='rank3' style='width:4rem;height:4rem'>
						</div>
						<div class='col-6'>
							<span class='my-0 font-8'>".strtoupper($sekolah['nama_cabang'])."</span>
							<h3 class=''>".strtoupper($sAll['nama_lengkap'])." </h3>
						</div>
						<div class='col-2 '>
							<h5 class='pt-3'>".$sAll['qp_poin']." POIN </h5>
						</div>
						
					</div>
				</div>";
				$rank++;
				}
			}else if($status == 'week'){
				$start = date( 'Y-m-d', strtotime( 'monday this week' ) );
				$rowS = $this->model_app->view_where('quiz_date',array('tanggal'=>$start,'kelas'=>$me['kelas']))->row_array();
				$end = date( 'Y-m-d', strtotime( 'sunday this week' ) );
				$rowE = $this->model_app->view_where('quiz_date',array('tanggal'=>$end,'kelas'=>$me['kelas']))->row_array();

				$getone = $this->db->query("SELECT a.nama_lengkap,c.nama_cabang,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto FROM siswa a JOIN quiz_partisipasi b 
						ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd JOIN quiz_date d ON b.qp_date = d.id_qd WHERE ( d.tanggal >= '".$start."' AND d.tanggal <= '".$end."'  ) AND a.id_sd = ".$me['id_sd']." AND a.kelas = '".$me['kelas']."'
						GROUP BY b.id_siswa
						ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 0,1  ")->row_array();
				$one = $getone['poin']/$getone['tot'];
				if($getone){
					$rankone = array('nama_cabang'=>$getone['nama_cabang'],'nama_lengkap'=>$getone['nama_lengkap'],'qp_poin'=>$one,'foto'=>$getone['foto']);
					
					

				}else{
					$rankone = null;
				}
				$gettwo =  $this->db->query("SELECT a.nama_lengkap,c.nama_cabang,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto FROM siswa a JOIN quiz_partisipasi b 
							ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd JOIN quiz_date d ON b.qp_date = d.id_qd WHERE ( d.tanggal >= '".$start."' AND d.tanggal <= '".$end."'  ) AND a.id_sd = ".$me['id_sd']." AND a.kelas = '".$me['kelas']."'
							GROUP BY b.id_siswa
							ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 1,2  ")->row_array();
				$two = $gettwo['poin']/$gettwo['tot'];
				if($gettwo){
					$ranktwo = array('nama_cabang'=>$gettwo['nama_cabang'],'nama_lengkap'=>$gettwo['nama_lengkap'],'qp_poin'=>$two,'foto'=>$gettwo['foto']);
					

				}else{
					$ranktwo = null;
				}

				$gettri =  $this->db->query("SELECT a.nama_lengkap,c.nama_cabang,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto FROM siswa a JOIN quiz_partisipasi b 
				ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd JOIN quiz_date d ON b.qp_date = d.id_qd WHERE ( d.tanggal >= '".$start."' AND d.tanggal <= '".$end."'  ) AND a.id_sd = ".$me['id_sd']." AND a.kelas = '".$me['kelas']."'
				GROUP BY b.id_siswa
				ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 2,3  ")->row_array();
				$tri = $gettri['poin']/$gettri['tot'];
				if($gettri){
					$ranktri = array('nama_cabang'=>$gettri['nama_cabang'],'nama_lengkap'=>$gettri['nama_lengkap'],'qp_poin'=>$tri,'foto'=>$gettri['foto']);

				}else{
					$ranktri = null;
				}
				$getAll = $this->db->query("SELECT a.nama_lengkap,c.nama_cabang,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto FROM siswa a JOIN quiz_partisipasi b 
											ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd JOIN quiz_date d ON b.qp_date = d.id_qd WHERE ( d.tanggal >= '".$start."' AND d.tanggal <= '".$end."'  ) AND a.id_sd = ".$me['id_sd']." AND a.kelas = '".$me['kelas']."'
											GROUP BY b.id_siswa
											ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 3,97  ");
				$all = null;
				$rank = 4;
				foreach($getAll->result_array() as $sAll){
					$allPoin = $sAll['poin']/$sAll['tot'];
							$all .= "<div class='col-12 mb-2 card-white p-1'>
							<div class='row'>
								<div class='col-1 '>
									<h3 class='pt-3'>".$rank.". </h3>
								</div>
								<div class='col-3'>
									<img src='".$sAll['foto']."'  alt='' class='mr-2 img-fluid rounded-circle border' id='rank3' style='width:4rem;height:4rem'>
								</div>
								<div class='col-6'>
									<span class='my-0 font-8'>".strtoupper($sAll['nama_cabang'])."</span>
									<h3 class=' my-0'>".strtoupper($sAll['nama_lengkap'])." </h3>
								</div>
								<div class='col-2 '>
									<h5 class='pt-3'>".$allPoin." POIN </h5>
								</div>
								
							</div>
						</div>";
					$rank++;
				}		
			}else if($status == 'month'){
				$start = date( 'Y-m-01' );
				$rowS = $this->model_app->view_where('quiz_date',array('tanggal'=>$start,'kelas'=>$me['kelas']))->row_array();
				$end = date( 'Y-m-t');
				$rowE = $this->model_app->view_where('quiz_date',array('tanggal'=>$end,'kelas'=>$me['kelas']))->row_array();

				$getone1 =  $this->db->query("SELECT a.nama_lengkap,c.nama_cabang,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto FROM siswa a JOIN quiz_partisipasi b 
								ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd JOIN quiz_date d ON b.qp_date = d.id_qd WHERE ( d.tanggal >= '".$start."' AND d.tanggal <= '".$end."'  ) AND a.id_sd = ".$me['id_sd']." AND a.kelas = '".$me['kelas']."'
								GROUP BY b.id_siswa
								ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 0,1  ")->row_array();
				$one = $getone1['poin']/$getone1['tot'];
				if($getone1){
					$rankone = array('nama_cabang'=>$getone1['nama_cabang'],'nama_lengkap'=>$getone1['nama_lengkap'],'qp_poin'=>$one,'foto'=>$getone1['foto']);
					
					

				}else{
					$rankone = null;
				}
				$gettwo1 = $this->db->query("SELECT a.nama_lengkap,c.nama_cabang,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto FROM siswa a JOIN quiz_partisipasi b 
				ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd JOIN quiz_date d ON b.qp_date = d.id_qd WHERE ( d.tanggal >= '".$start."' AND d.tanggal <= '".$end."'  ) AND a.id_sd = ".$me['id_sd']." AND a.kelas = '".$me['kelas']."'
				GROUP BY b.id_siswa
				ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 1,2  ")->row_array();
				$two = $gettwo1['poin']/$gettwo1['tot'];
				if($gettwo1){
					$ranktwo = array('nama_cabang'=>$gettwo1['nama_cabang'],'nama_lengkap'=>$gettwo1['nama_lengkap'],'qp_poin'=>$two,'foto'=>$gettwo1['foto']);
					

				}else{
					$ranktwo = null;
				}

				$gettri1 = $this->db->query("SELECT a.nama_lengkap,c.nama_cabang,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto FROM siswa a JOIN quiz_partisipasi b 
				ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd JOIN quiz_date d ON b.qp_date = d.id_qd WHERE ( d.tanggal >= '".$start."' AND d.tanggal <= '".$end."'  ) AND a.id_sd = ".$me['id_sd']." AND a.kelas = '".$me['kelas']."'
				GROUP BY b.id_siswa
				ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 2,3  ")->row_array();
				$tri = $gettri1['poin']/$gettri1['tot'];
				if($gettri1){
					$ranktri = array('nama_cabang'=>$gettri1['nama_cabang'],'nama_lengkap'=>$gettri1['nama_lengkap'],'qp_poin'=>$tri,'foto'=>$gettri1['foto']);

				}else{
					$ranktri = null;
				}
				$getAll = $this->db->query("SELECT a.nama_lengkap,c.nama_cabang,SUM(b.qp_poin) as poin,COUNT(b.id_qp) as tot,a.foto FROM siswa a JOIN quiz_partisipasi b 
				ON a.id_siswa = b.id_siswa JOIN subdomain c ON a.id_sd = c.id_sd JOIN quiz_date d ON b.qp_date = d.id_qd WHERE ( d.tanggal >= '".$start."' AND d.tanggal <= '".$end."'  ) AND a.id_sd = ".$me['id_sd']." AND a.kelas = '".$me['kelas']."'
				GROUP BY b.id_siswa
				ORDER BY qp_poin DESC,quiz_duration ASC LIMIT 3,97  ");
				$all = null;
				$rank = 4;
				foreach($getAll->result_array() as $sAll){
					$allPoin = $sAll['poin']/$sAll['tot'];
							$all .= "<div class='col-12 mb-2 card-white p-1'>
							<div class='row'>
								<div class='col-1 '>
									<h3 class='pt-3'>".$rank.". </h3>
								</div>
								<div class='col-3'>
									<img src='".$sAll['foto']."'  alt='' class='mr-2 img-fluid rounded-circle border' id='rank3' style='width:4rem;height:4rem'>
								</div>
								<div class='col-6'>
									<span class='my-0 font-8'>".strtoupper($sAll['nama_cabang'])."</span>
									<h3 class=''>".strtoupper($sAll['nama_lengkap'])." </h3>
								</div>
								<div class='col-2 '>
									<h5 class='pt-3'>".$allPoin." POIN </h5>
								</div>
								
							</div>
						</div>";
					$rank++;
				}		
				
			}
			$arr = ['rankone'=>$rankone,'ranktwo'=>$ranktwo,'ranktri'=>$ranktri,'all'=>$all];
			echo json_encode($arr);
		
		
	}

}

?>