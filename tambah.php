<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Student &raquo; Tambah Data Student</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add" pada baris 164 ditekan
				$nim		     = $_POST['nim'];
				$nama		     = $_POST['nama'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$alamat_asal     = $_POST['alamat_asal'];
				$alamat_sekarang = $_POST['alamat_sekarang'];
				$no_telepon		 = $_POST['no_telepon'];
				$jadwal1		 	= $_POST['jadwal1'];
				$jadwal2		 	= $_POST['jadwal2'];
				$jadwal3		 	= $_POST['jadwal3'];
				

				//$insert = mysqli_query($koneksi, "INSERT INTO mahasiswa(nim, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat_asal, alamat_sekarang, no_telepon, jadwal) VALUES('$nim','$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat_asal', '$alamat_sekarang', '$no_telepon', '$jadwal')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
				
				
				$cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'"); // query untuk memilih entri dengan nim terpilih
				if(mysqli_num_rows($cek) == 0){ // mengecek apakah nim yang akan ditambahkan tidak ada dalam database
						$insert = mysqli_query($koneksi, "INSERT INTO mahasiswa(nim, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat_asal, alamat_sekarang, no_telepon, jadwal_1, jadwal_2, jadwal_3) VALUES('$nim','$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat_asal', '$alamat_sekarang', '$no_telepon', '$jadwal1', '$jadwal2', '$jadwal3')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Mahasiswa Berhasil Di Simpan. <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Mahasiswa Gagal Di simpan! <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}
					} 
				else{ // mengecek jika nim yang akan ditambahkan sudah ada dalam database
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>NIM Sudah Ada..! <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'nim Sudah Ada..!'
				}
			}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<?php 
					$sql = mysqli_query($koneksi, "SELECT nim FROM mahasiswa ORDER BY nim DESC");
					$row = mysqli_fetch_assoc($sql)
					
					?>
					<label class="col-sm-3 control-label">NIS</label>
					<div class="col-sm-2">
						<input type="text" value="<?php echo $row['nim'] + 1; ?>" name="nim" class="form-control" placeholder="nis" readonly required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value=""> ----- </option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-3">
						<input type="text" id="date" name="tanggal_lahir" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat Asal</label>
					<div class="col-sm-3">
						<textarea name="alamat_asal" class="form-control" placeholder="Alamat Asal"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat Sekarang</label>
					<div class="col-sm-3">
						<textarea name="alamat_sekarang" class="form-control" placeholder="Alamat Sekarang"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="number" name="no_telepon" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Pilih Jadwal 1</label>
					<div class="col-sm-7">
						<?php
						$sql = mysqli_query($koneksi, "SELECT a.*, b.nama_users
														FROM jadwal a
														LEFT JOIN users b
														ON a.id_guru=b.id WHERE nama_pelajaran='MATEMATIKA'");
						?>
						<?php
						  while($row = mysqli_fetch_assoc($sql)){
						?>
							<div class="checkbox">
							  <label><input name="jadwal1" type="checkbox" value="<?php echo $row['kode_jadwal'];?>"><?php echo $row['nama_pelajaran'];?> <?php echo $row['hari']; ?> <?php echo $row['jam']; ?> (<?php echo $row['nama_users']; ?>)</label>
							</div>
							
						<?php
						  }
						?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Pilih Jadwal 2</label>
					<div class="col-sm-7">
						<?php
						$sql = mysqli_query($koneksi, "SELECT a.*, b.nama_users
														FROM jadwal a
														LEFT JOIN users b
														ON a.id_guru=b.id WHERE nama_pelajaran='ENGLISH'");
						?>
						<?php
						  while($row = mysqli_fetch_assoc($sql)){
						?>
							<div class="checkbox">
							  <label><input name="jadwal2" type="checkbox" value="<?php echo $row['kode_jadwal'];?>"><?php echo $row['nama_pelajaran'];?> <?php echo $row['hari']; ?> <?php echo $row['jam']; ?> (<?php echo $row['nama_users']; ?>)</label>
							</div>
							
						<?php
						  }
						?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Pilih Jadwal 3</label>
					<div class="col-sm-7">
						<?php
						$sql = mysqli_query($koneksi, "SELECT a.*, b.nama_users
														FROM jadwal a
														LEFT JOIN users b
														ON a.id_guru=b.id WHERE nama_pelajaran='FISIKA'");
						?>
						<?php
						  while($row = mysqli_fetch_assoc($sql)){
						?>
							<div class="checkbox">
							  <label><input name="jadwal3" type="checkbox" value="<?php echo $row['kode_jadwal'];?>"><?php echo $row['nama_pelajaran'];?> <?php echo $row['hari']; ?> <?php echo $row['jam']; ?> (<?php echo $row['nama_users']; ?>)</label>
							</div>
							
						<?php
						  }
						?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data mahasiswa">
						<a href="home.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>
