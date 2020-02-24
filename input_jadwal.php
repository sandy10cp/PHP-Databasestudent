<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Tambah Jadwal</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add" pada baris 164 ditekan
				$kode_jadwal		     = $_POST['kode_jadwal'];
				$nama_pelajaran  		 = $_POST['nama_pelajaran'];
				$id_guru	 			= $_POST['id_guru'];
				$hari	 				= $_POST['hari'];
				$jam     				= $_POST['jam'];
				
				$sub_pelajaran	= substr($nama_pelajaran,0,3);
				
				$cek = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE nama_pelajaran='$nama_pelajaran'");
				$count = mysqli_num_rows($cek);
				$kode = $count + 1;
				$gabung = $sub_pelajaran.'0'.$kode;
				//echo "BIO0$kode";
				//$insert = mysqli_query($koneksi, "INSERT INTO mahasiswa(nim, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat_asal, alamat_sekarang, no_telepon, jadwal) VALUES('$nim','$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat_asal', '$alamat_sekarang', '$no_telepon', '$jadwal')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
				
				
				$insert = mysqli_query($koneksi, "INSERT INTO jadwal(kode_jadwal, kode_pelajaran, nama_pelajaran, id_guru, hari, jam) VALUES('$kode_jadwal','$gabung', '$nama_pelajaran', '$id_guru', '$hari', '$jam')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Jadwal Berhasil Di Simpan. <a href="jadwal.php"><- Kembali</a></div>'; // maka tampilkan 'Jadwal Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Jadwal Gagal Di simpan!</div>'; // maka tampilkan 'Ups, Jadwal Gagal Di simpan!'
						}
			}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">KODE JADWAL</label>
					<div class="col-sm-2">
					<?php 
					$sql = mysqli_query($koneksi, "SELECT id FROM jadwal ORDER BY id DESC");
					$row = mysqli_fetch_assoc($sql)
					
					?>
						<input type="text" value="JDW0<?php echo $row['id']+1; ?>" name="kode_jadwal" class="form-control" placeholder="Kode Jadwal" readonly required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA PELAJARAN</label>
					<div class="col-sm-4">
						<input type="text" name="nama_pelajaran" class="form-control" placeholder="Nama Pelajaran" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">TEACHER</label>
					<div class="col-sm-3">
						<select name="id_guru" class="form-control" required>
							<option value=""> ----- </option>
							<?php
							$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE akses = 'Teacher'");
							?>
							<?php
							  while($row = mysqli_fetch_assoc($sql)){
							?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['nama_users'];?></option>
							<?php
							  }
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">HARI</label>
					<div class="col-sm-4">
						<input type="text" name="hari" class="form-control" placeholder="Hari" required>
						(<i>Example : SENIN-SELASA-RABU</i>)
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">JAM</label>
					<div class="col-sm-4">
						<input type="text" name="jam" class="form-control" placeholder="Jam" required>
						(<i>Example : 14:00 - 15:00</i>)
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Jadwal">
						<a href="jadwal.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>
