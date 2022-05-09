<?php
/*
-- ---------------------------------------------------------------
-- PROFILE --
-- JUA KOPI --
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller {
 public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
          $this->session->set_userdata('referred_from', current_url()); 
	
    }
	public function index()
	{
        $this->load->view('upload_guru');

		
	}
    public function siswa()
	{
        $this->load->view('upload_siswa');

		
	}
    function do_siswa(){
        if($this->input->method() == 'post'){
            $file = $_FILES['file']['tmp_name'];

			// Medapatkan ekstensi file csv yang akan diimport.
			$ekstensi  = explode('.', $_FILES['file']['name']);

			// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
			if (empty($file)) {
				echo 'File tidak boleh kosong!';
			} else {
				// Validasi apakah file yang diupload benar-benar file csv.
				if (strtolower(end($ekstensi)) === 'csv' && $_FILES["file"]["size"] > 0) {

                    $i = 0;
					$handle = fopen($file, "r");
                    $data = array();
					while (($row = fgetcsv($handle, 2048))) {
						$i++;
						if ($i == 1) continue;
                        $cek = $this->db->query("SELECT * FROM siswa WHERE nisn = '".$row[4]."' OR nipd = '".$row[2]."' AND no_hp = '".$row[19]."' ")->num_rows();
                        if($cek == 0){
                            if($row[3] == 'L'){
                                $jk = 'male';
                            }else{
                                $jk = 'female';
                            }
                            $nik = $row[7];
                            $ke = explode(' ',$row[42]);
                            $data = [
                                'id_sd' => decode($this->input->post('sekolah')),
                                'nama_lengkap'=>$row[1],
                                'nipd'=>$row[2],
                                'jenis_kelamin'=>$jk,
                                'nisn'=>$row[4],
                                'tempat_lahir'=>$row[5],
                                'tanggal_lahir'=>date('Y-m-d',strtotime($row[6])),
                                'agama'=>strtolower($row[8]),
                                'alamat'=>$row[9],
                                'rt'=>$row[10],
                                'rw'=>$row[11],
                                'dusun'=>$row[12],
                                'kelurahan'=>0,
                                'provinsi'=>76,
                                'kecamatan'=>0,
                                'kabupaten'=>7604,
                                'kode_pos'=>$row[15],
                                'jenis_tinggal'=>$row[16],
                                'alat_transportasi'=>$row[17],
                                'no_telp'=>$row[18],
                                'no_hp'=>$row[19],
                                'email'=>$row[20],
                                'kelas'=>romawi($ke[1]),
                                'foto'=>base_url('asset/upload_sklh/blank.png'),
                                'password'=>encode('12345678'),
    
                                
    
                            ];
                            $id = $this->model_app->insert_id('siswa',$data);
                            // $id = 0;
                            if($row[24] != '' OR $row[24] != NULL){
                                $dataA = [
                                    'id_siswa'=>$id,
                                    'status_wali'=>'ayah',
                                    'nama'=>$row[24],
                                    'tahun'=>date('Y',strtotime($row[25])),
                                    'jenjang_pendidikan'=>$row[26],
                                    'pekerjaan'=>$row[27],
                                    'penghasilan'=>$row[28],
                                    'nik'=>$row[29],
                                ];
                                $this->model_app->insert('siswa_wali',$dataA);
                            }
                            if($row[30] != '' OR $row[30] != NULL){
                                $dataI = [
                                    'id_siswa'=>$id,
                                    'status_wali'=>'ibu',
                                    'nama'=>$row[30],
                                    'tahun'=>date('Y',strtotime($row[31])),
                                    'jenjang_pendidikan'=>$row[32],
                                    'pekerjaan'=>$row[33],
                                    'penghasilan'=>$row[34],
                                    'nik'=>$row[35],
                                ];
                                $this->model_app->insert('siswa_wali',$dataI);
                            }
                            if($row[36] != '' OR $row[36] != NULL){
                                $dataW = [
                                    'id_siswa'=>$id,
                                    'status_wali'=>'wali',
                                    'nama'=>$row[36],
                                    'tahun'=>date('Y',strtotime($row[37])),
                                    'jenjang_pendidikan'=>$row[38],
                                    'pekerjaan'=>$row[39],
                                    'penghasilan'=>$row[40],
                                    'nik'=>$row[41],
                                ];
                                $this->model_app->insert('siswa_wali',$dataI);
                            }
                            if($row[45] == 'Ya'){
                                $kip = 'y';
                            }else{
                                $kip = 'n';
                            }
                            if($row[53] == 'Ya'){
                                $pip = 'y';
                            }else{
                                $pip = 'n';
                            }
                            $dataP = [
                                    'id_siswa'=>$id,
                                    'nik'=>$nik,
                                    'skhun'=>$row[21],
                                    'penerima_kps'=>$row[22],
                                    'no_kps'=>$row[23],
                                    'no_peserta_ujian_nasional'=>$row[43],
                                    'no_seri_ijazah'=>$row[44],
                                    'penerima_kip'=>$kip,
                                    'nomor_kip'=>$row[46],
                                    'nama_kip'=>$row[47],
                                    'nomor_kks'=>$row[48],
                                    'no_registrasi_akta_lahir'=>$row[49],
                                    'bank'=>$row[50],
                                    'nomor_rekening_bank'=>$row[51],
                                    'rekening_atas_nama'=>$row[52],
                                    'layak_pip'=>$pip,
                                    'alasan_layak_pip'=>$row[54],
                                    'kebutuhan_khusus'=>$row[55],
                                    'sekolah_asal'=>$row[56],
                                    'anak_ke'=>$row[57],
                                    'lintang'=>$row[58],
                                    'bujur'=>$row[59],
                                    'no_kk'=>$row[60],
                                    'berat_badan'=>$row[61],
                                    'tinggi_badan'=>$row[62],
                                    'lingkar_kepala'=>$row[63],
                                    'jml_saudara'=>$row[64],
                                    'jarak_ke_sekolah'=>$row[65],
                                    
                            ];
                            $this->model_app->insert('siswa_data',$dataP);

                            echo $row[1].' Inserted <br>';
                        }else{
                            echo $row[1].' Dupliacted data <br>';
                        }
                        
                        
                    }
                	fclose($handle);
					

				} else {
					echo 'Format file tidak valid!';
				}
            }
        }
    }
    function do_guru(){
        if($this->input->method() == 'post'){
            $file = $_FILES['file']['tmp_name'];

			// Medapatkan ekstensi file csv yang akan diimport.
			$ekstensi  = explode('.', $_FILES['file']['name']);

			// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
			if (empty($file)) {
				echo 'File tidak boleh kosong!';
			} else {
				// Validasi apakah file yang diupload benar-benar file csv.
				if (strtolower(end($ekstensi)) === 'csv' && $_FILES["file"]["size"] > 0) {

					$i = 0;
					$handle = fopen($file, "r");
                    $data = array();
					while (($row = fgetcsv($handle, 2048))) {
						$i++;
						if ($i == 1) continue;
                        if($row[3] == 'P'){
                            $jk = 'female';
                        }else{
                            $jk = 'male';
                        }
                        if($row[34] == 'Ya'){
                            $lisensi = 'y';
                        }else{
                            $lisensi = 'n';
                        }

                        if($row[35] == 'Ya'){
                            $diklat = 'y';
                        }else{
                            $diklat = 'n';
                        }

                        if($row[36] == 'Ya'){
                            $braile = 'y';
                        }else{
                            $braile = 'n';
                        }

                        if($row[37] == 'Ya'){
                            $isyarat = 'y';
                        }else{
                            $isyarat = 'n';
                        }
                        if($row[51] == 'Ya'){
                            $nuks = 'y';
                        }else{
                            $nuks = 'n';
                        }
                        if($row[1] != NULL){
                            $cek = $this->db->query("SELECT * FROM guru WHERE email = '".$row[1]."' OR nip = '".$row[6]."' OR nuptk = '".$row[2]."' OR nik ='".$row[44]."'");
                            if($cek->num_rows() == 0){
                                $data = [
                                    'id_sd'=>decode($this->input->post('sekolah')),
                                    'nama_guru'=>$row[1],
                                    'nuptk'=>$row[2],
                                    'jenis_kelamin'=>$jk,
                                    'tempat_lahir'=>$row[4],
                                    'tanggal_lahir'=>date('Y-m-d',strtotime($row[5])),
                                    'nip'=>$row[6],
                                    'status_kepegawaian'=>$row[7],
                                    'jenis_ptk'=>$row[8],
                                    'agama'=>strtolower($row[9]),
                                    'alamat'=>$row[10],
                                    'rt'=>$row[11],
                                    'rw'=>$row[12],
                                    'kecamatan'=>0,
                                    'kelurahan'=>0,
                                    'kode_pos'=>$row[16],
                                    'telepon'=>$row[17],
                                    'hp'=>$row[18],
                                    'email'=>$row[19],
                                    'tugas_tambahan'=>$row[20],
                                    'sk_cpns'=>$row[21],
                                    'tanggal_cpns'=>date('Y-m-d',strtotime($row[22])),
                                    'sk_pengangkatan'=>$row[23],
                                    'tmt_pengangkatan'=>date('Y-m-d',strtotime($row[24])),
                                    'lembaga_pengangkatan'=>$row[25],
                                    'pangkat_golongan'=>$row[26],
                                    'sumber_gaji'=>$row[27],
                                    'nama_ibu_kandung'=>$row[28],
                                    'status_perkawinan'=>strtolower($row[29]),
                                    'nama_pasangan'=>$row[30],
                                    'nip_pasangan'=>$row[31],
                                    'pekerjaan_pasangan'=>$row[32],
                                    'tmt_pns'=>date('Y-m-d',strtotime($row[33])),
                                    'lisensi_kepsek'=>$lisensi,
                                    'diklat_kepengawasan'=>$diklat,
                                    'keahlian_braille'=>$braile,
                                    'keahlian_bahasa_syarat'=>$isyarat,
                                    'npwp'=>$row[38],
                                    'nama_wajib_pajak'=>$row[39],
                                    'kewarganegaraan'=>strtoupper($row[40]),
                                    'bank'=>$row[41],
                                    'nomor_rekening'=>$row[42],
                                    'atas_nama'=>$row[43],
                                    'nik'=>$row[44],
                                    'no_kk'=>$row[45],
                                    'karpeg'=>$row[46],
                                    'karis/karsu'=>$row[47],
                                    'lintang'=>$row[48],
                                    'bujur'=>$row[49],
                                    'nuks'=>$nuks,
                                    'foto'=>base_url('asset/upload_sklh/blank.png'),
                                    'password'=>encode('12345678'),
                                    'status'=>'active',
                                    
                                ];
                                $this->model_app->insert('guru',$data);
                                echo $row[1].'Inserted';
                            }
                           
                        }
						// Data yang akan disimpan ke dalam databse
						
                        // 
                      
                        
						// Simpan data ke database.
						
					}
                    
                   

					fclose($handle);
					

				} else {
					echo 'Format file tidak valid!';
				}
            }
        }
    }
}