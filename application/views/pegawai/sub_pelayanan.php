
	<label>Jenis</label>
	<select class="form-control" id="sub_pelayanan" name="sub_pelayanan">
		<option></option>
		<?php foreach($record->result_array() as $row):

			$l = $row['link'];
			$link = base_url('').$this->uri->segment('1').'/'.$l;
		?>
				<option value="<?= $link ?>"><?= $row['sub_pelayanan']?></option>
		<?php endforeach;?>
	</select>
<input type="hidden" name="" id="status_pel" value="1">
