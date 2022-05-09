<html>
    <head></head>
    <body>
    <?php echo form_open_multipart(base_url('upload/do_siswa')); ?>
            <select name="sekolah" id=""></select>
             <input type="file" name="file" required accept=".xlsx,.xls,.csv">
             <input type="submit" value="submit">
        </form>
    </body>
</html>