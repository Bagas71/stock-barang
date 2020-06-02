<?php 
require 'functions.php';

$id = $_GET["id"];

if( hapusJenisBarang($id) > 0 ){

		echo "
			<script>
				alert('data berhasil dihapus!')
				document.location.href = 'hasil_jenis_barang.php';
			</script>
		";
	}else{
			echo "
			<script>
				alert('data gagal dihapus!')
				document.location.href = 'hasil_jenis_barang.php';
			</script>
			";
		
	}

 ?>