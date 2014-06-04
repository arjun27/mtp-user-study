<?php
	$data = $_POST['data'];
	file_put_contents ( 'results/result', $data );
?> 