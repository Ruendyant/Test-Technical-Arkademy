<?php

$mysqli = new mysqli('localhost', 'root', '', 'web') or die($mysqli_error($mysqli));

session_start();

$update = false;
$name='';
$keterangan='';
$harga='';
$jumlah='';

if(isset($_POST['save'])) 
{
	$name = $_POST['name'];
	$keterangan = $_POST['keterangan'];
	$harga = $_POST['harga'];
	$jumlah = $_POST['jumlah'];

	$_SESSION['massage'] = "Data saved";
	$_SESSION['msg_type'] = "success";

	$mysqli->query("INSERT INTO produk(nama, keterangan, harga, jumlah) VALUES ('$name', '$keterangan', '$harga', '$jumlah')")
	 or die($mysqli->error);

	 header("location", "index.php");

}

if(isset($_GET['delete']))
{
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM produk WHERE id=$id") or die($mysqli->error());

	$_SESSION['massage'] = "Data deleted";
	$_SESSION['msg_type'] = "danger";

	header("location", "index.php");
}

if(isset($_GET['edit']))
{
	$id = $_GET['edit'];
	$result = $mysqli->query("SELECT * FROM produk WHERE id=$id");
	if(count($result) == 1 && $result)
	{
		$row = $result->fetch_array();
		$update = true;
		$name = $row['nama'];
		$keterangan = $row['keterangan'];
		$harga = $row['harga'];
		$jumlah = $row['jumlah'];
	}
}

if(isset($_POST['update']))
{
	$id = $_POST['id'];
	$name = $_POST['name'];
	$keterangan = $_POST['keterangan'];
	$harga = $_POST['harga'];
	$jumlah = $_POST['jumlah'];

	$mysqli->query("UPDATE produk SET nama=$name, keterangan=$keterangan, harga=$harga, jumlah=$jumlah WHERE id='$id'");

	$_SESSION['massage'] = "Data updated";
	$_SESSION['msg_type'] = "warning";

	header("location", "index.php");
}