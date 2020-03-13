<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

	$response = array();
	//mendapatkan data
	$npm = $_POST['npm'];
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$sesi = $_POST['sesi'];

	require_once('dbconnect.php');
	//cek npm sudah terdaftar apa belum
	$sql = "SELECT * FROM mahasiswa WHERE npm ='$npm'";
	$check = mysqli_fetch_array(mysqli_query($con,$sql));
	if(isset($check)){
		$response["value"] = 0;
		$response["message"] = "oops! NPM belum terdaftar!";
		echo json_decode($response);
	} else{
		$sql = "INSERT INTO mahasiswa (npm,nama,kelas,sesi) VALUES('$npm','$nama','$kelas','$sesi')";
		if(mysqli_query($con,$sql)){
			$response["value"] = 1;
			$response["message"] = "Sukses mendaftar";
			echo json_encode($response);
		} else{
			$response["value"] = 0;
			$response["message"] = "Oopss! Coba lagi!";
			echo json_encode($response);
		}
	}

	//tutupdatabase
	mysqli_close($con);
} else{
	$response["value"] = 0;
	$response["message"] = "Oopss! Coba lagi!";
	echo json_encode($response);
}