
	
		<option></option>
		<?php foreach($record->result_array() as $row):

			$l = 'search_'.$row['link'];
			$link = base_url('').$this->uri->segment('1').'/'.$l;
		?>
				<option value="<?= $link ?>"><?= $row['sub_pelayanan']?></option>
		<?php endforeach;?>
