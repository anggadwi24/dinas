<html>
    <head></head>
    <body>
    <?php echo form_open_multipart(base_url('upload/do_guru')); ?>
            <select name="sekolah" id="" required> 
                <?php 
                    $sekolah = $this->model_app->view_where('subdomain',array('status'=>'sekolah'));
                    foreach($sekolah->result_array() as $skh){
                        echo "<option value='".encode($skh['id_sd'])."'>".$skh['nama_cabang']."</option>";
                    }
                ?>
            </select>
             <input type="file" name="file" required accept=".xlsx,.xls,.csv">
             <input type="submit" value="submit">
        </form>
    </body>
</html>