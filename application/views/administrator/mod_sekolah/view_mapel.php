<?php
  $id = $this->session->id_session;
 $link = 'administrator/mataPelajaran/add';
 $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
?>
<div class="col-xs-12">  
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"> Daftar Mata Pelajaran</h3>
                  
                    <?php if($c>0){?>
                    <a class='mt-5 btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/mataPelajaran/add'>Tambah</a>
                    <?php }?>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                            <thead>
                            <tr>
                                <th style='width:20px'>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                            
                            
                                <th>Action</th>
                            
                                
                                
                            </tr>
                            </thead>
                            <tbody>
                        <?php 
                        
                            if($record->num_rows() > 0){
                                $no = 1;
                            
                                $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/mataPelajaran/edit'")->num_rows();
                                $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/mataPelajaran/hapus'")->num_rows();
                               
                                foreach ($record->result_array() as $row){
                                    if($u > 0){
                                        $edit = '<a class="btn btn-warning mr-2" href="'.base_url('administrator/mataPelajaran/edit?id='.encode($row['mapel_id'])).'"><i class="fa fa-edit"></i></a>';
                                    }else{
                                        $edit = '';
                                    }
                                    if($d > 0){
                                        $hapus = '<a class="btn btn-danger" href="'.base_url('administrator/mataPelajaran/hapus?id='.encode($row['mapel_id'])).'"><i class="fa fa-trash"></i></a>';
                                    }else{
                                        $hapus = '';
                                    }

                                    echo "<tr><td>$no</td>
                                            <td>".ucfirst($row['mapel'])."</td>
                                            <td>".$row['mapel_kelas']."</td>
                                            <td>".$edit." ".$hapus."</td>
                                            
                                            
                                            
                                            
                                        </tr>";
                                    $no++;
                                    }
                            }
                        
                        ?>
                        </tbody>
                        </table>
                    </div>
                  </div>
                  
    