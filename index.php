<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<?php require_once "process.php"; ?>
	<?php 
		if(isset($_SESSION['massage'])): ?>

	<div class="alert alert-<?=$_SESSION['msg_type']?>">
		<?php 
			echo $_SESSION['massage'];
			unset($_SESSION['massage']);
		?>
	</div>
<?php endif ?>
	<?php 
		$mysqli = new mysqli('localhost', 'root', '', 'web') or die(mysql_error($mysqli));
		$result = $mysqli->query("SELECT * FROM produk") or die($mysqli->error); ?>

	<div class="row justify-content-center">
		<table class="table">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Keterangan</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th colspan="3">Perintah</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($data = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $data['nama']; ?></td>
						<td><?php echo $data['keterangan']; ?></td>
						<td><?php echo $data['harga']; ?></td>
						<td><?php echo $data['jumlah']; ?></td>
						<td>
							<a href="index.php?edit=<?php echo $data['id']; ?>" class="btn btn-info">Edit</a>
							<a href="index.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	<div class="row justify-content-center">
		<form action="process.php" method="POST">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<label>Nama: </label>
				<input type="text" name="name" placeholder="Enter Name Product" class="form-control" value="<?php echo $name ?>">
			</div>
			<div class="form-group">
				<label>Keterangan: </label>
				<input type="text" name="keterangan" placeholder="Keterangan" class="form-control" value="<?php echo $keterangan ?>">
			</div>
			<div class="form-group">
				<label>Harga: </label>
				<input type="text" name="harga" placeholder="Harga" class="form-control" value="<?php echo $harga ?>">
			</div>
			<div class="form-group">
				<label>Jumlah: </label>
				<input type="text" name="jumlah" placeholder="Jumlah" class="form-control" value="<?php echo $jumlah ?>">
			</div>
			<div class="form-group">
				<?php if($update == true):?>
					<button type="submit" name="save" class="btn btn-primary">Submit</button>
				<?php else:?>
				<button type="submit" name="save" class="btn btn-primary">Submit</button>
				<?php endif ?>
			</div>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>