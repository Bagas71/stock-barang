<?php 
$conn = mysqli_connect("localhost","root","","frozen");

function query($query){
	global $conn;
	$result = mysqli_query($conn,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows [] = $row;
	}
	return $rows;
}

function cari($keyword){
	$query = "SELECT tabel_barang.id, tabel_barang.nama_barang, 
                tabel_barang.harga_barang, tabel_jenis_barang.jenis_barang, 
                tabel_barang.stock_barang, tabel_barang.gambar 
                FROM tabel_barang 
                JOIN tabel_jenis_barang 
                ON tabel_jenis_barang.id = tabel_barang.jenis_barang WHERE tabel_barang.nama_barang  LIKE '%$keyword%'";
	return query($query);
}

// tambah data barang
	function tambahBarang($data){
	global $conn;

	$nama_barang = htmlspecialchars($data["nama"]);
	$harga_barang = htmlspecialchars($data["harga"]);
	$jenis_barang = htmlspecialchars($data["jenis"]);	
	$stock_barang = htmlspecialchars($data["stock"]);

	//upload gambar
	$gambar = upload();
	if(!$gambar){
		return false;
	}

	$query = "INSERT INTO tabel_barang VALUES ('','$nama_barang','$harga_barang','$jenis_barang', '$stock_barang','$gambar')";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

	function upload(){

		$namaFile = $_FILES["gambar"]["name"];
		$ukuranFile = $_FILES["gambar"]["size"];
		$error = $_FILES["gambar"]["error"];
		$tmpName = $_FILES["gambar"]["tmp_name"];

		//cek apakah tidak ada gambar di upload
		if( $error === 4){
			echo "<script>
				alert('pilih gambar terlebih dahulu!')
				</script>";
			return false; 
		}

		// cek apakah yang diupload adalah gambar
		$ekstensiGambarValid = ['jpg','jpeg','png',
		 'mpeg'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
			echo "<script>
				alert('yang di upload bukan gambar!')
				</script>";
				return false;
		}

		// cek jika ukuran yang di upload terlalu besar
		if( $ukuranFile > 100000000 ){
				echo "<script>
				alert('ukuran gambar terlalu besar!')
				</script>";
				return false;
		}

		// lolos pengecekkan, gambar siap di upload
		// generate nama gambar
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiGambar;
		
		move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

		return $namaFileBaru; 
}

// ubah data barang
	function ubahBarang($data){
	global $conn;
	$id = $data["id"];
	$nama_barang = htmlspecialchars($data["nama"]);
	$harga_barang = htmlspecialchars($data["harga"]);
	$jenis_barang = htmlspecialchars($data["jenis"]);
	$stock_barang = htmlspecialchars($data["stock"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user memilih gambar baru at tidak
	if ($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	}else{
		$gambar = upload();
	}

	$query = "UPDATE tabel_barang SET 
				nama_barang = '$nama_barang',
				harga_barang = '$harga_barang',
				jenis_barang = '$jenis_barang',
				stock_barang = '$stock_barang',
				gambar = '$gambar' 
					WHERE 
				id = $id";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

// hapus data barang
function hapusBarang($id){
	global $conn;
	$sql = mysqli_query($conn, "SELECT * FROM tabel_barang WHERE id=$id");
	foreach ($sql as $key) {
		echo $key['gambar'];
		unlink("img/".$key['gambar']);
	}
	mysqli_query($conn, "DELETE FROM tabel_barang WHERE id=$id");
	return mysqli_affected_rows($conn);
}

// tambah data jenis barang / item
function tambah_jenisBarang($data){
	global $conn;

	$jenis = htmlspecialchars($data["jenis"]);


	$query = "INSERT INTO tabel_jenis_barang VALUES ('','$jenis')";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

// ubah data jenis barang / item
function ubahJenisBarang($data){
	global $conn;
 	$id = $data["id"];
	$jenis = htmlspecialchars($data["jenis"]);


	$query = "UPDATE tabel_jenis_barang SET 
				jenis_barang = '$jenis'
				WHERE id = $id";
	$data = mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// hapus data jenis barang / item
function hapusJenisBarang($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tabel_jenis_barang WHERE id=$id");
	return mysqli_affected_rows($conn);
}
 ?>