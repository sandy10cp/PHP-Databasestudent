<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Student</h2>
			<hr />
			<?php
			if($result['akses'] == 'Kepalasekolah'){
				echo'
				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Student </button>
				</div> <!-- /div-action -->
				';
			}
			?>
				
			<?php
			if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete'
				$nim = $_GET['nim']; // ambil nilai nim
				$cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'"); // query untuk memilih entri dengan nim yang dipilih
				if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri nim yang dipilih
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; // maka tampilkan 'Data tidak ditemukan.'
				}else{ // mengecek jika terdapat entri nim yang dipilih
					$delete = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'"); // query untuk menghapus
					if($delete){ // jika query delete berhasil dieksekusi
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
					}else{ // jika query delete gagal dieksekusi
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
					}
				}
			}
			?>
			
			<?php
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add"
				$nim		     = $_POST['nim'];
				$nama		     = $_POST['nama'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$alamat_asal     = $_POST['alamat_asal'];
				$alamat_sekarang = $_POST['alamat_sekarang'];
				$no_telepon		 = $_POST['no_telepon'];
				$jadwal		 	= $_POST['jadwal'];
				
				$insert = mysqli_query($koneksi, "INSERT INTO mahasiswa(nim, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat_asal, alamat_sekarang, no_telepon, jadwal_1) VALUES('$nim','$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat_asal', '$alamat_sekarang', '$no_telepon', '$jadwal')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Mahasiswa Berhasil Di Simpan.</div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Mahasiswa Gagal Di simpan!</div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}
			}
			?>
			
			
			<!-- bagian ini untuk memfilter data berdasarkan pelajaran -->
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filter Data Student</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="JDW01" <?php if($filter == 'JDW01'){ echo 'selected'; } ?>>MATEMATIKA</option>
						<option value="JDW02" <?php if($filter == 'JDW02'){ echo 'selected'; } ?>>ENGLISH</option>
					</select> (Filter data by Pelajaran)
				</div>
			</form> <!-- end filter -->
			<br />
			<!-- memulai tabel responsive -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>No Telepon</th>
						<th>Tools</th>
					</tr>
					<?php
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE jadwal_1='$filter' ORDER BY nim ASC"); // query jika filter dipilih
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nim ASC"); // jika tidak ada filter maka tampilkan semua entri
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['nim'].'</td>
								<td><a href="profile.php?nim='.$row['nim'].'">'.$row['nama'].'</a></td>
								<td>'.$row['jenis_kelamin'].'</td>
								<td>'.$row['tempat_lahir'].'</td>
								<td>'.$row['tanggal_lahir'].'</td>
								<td>'.$row['no_telepon'].'</td>
								';
								if($result['akses']=='Kepalasekolah'){
									echo'
									<td>
								
									<a href="edit.php?nim='.$row['nim'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="data.php?aksi=delete&nim='.$row['nim'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
									';
								}else{
									
								}
							echo '
							</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
						}
					}
					?>
				</table>
			</div> <!-- /.table-responsive -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->



<!-- add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Student</h4>
	      </div>

	      <!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
				<div class="form-group">
				<?php 
					$sql = mysqli_query($koneksi, "SELECT nim FROM mahasiswa ORDER BY nim DESC");
					$row = mysqli_fetch_assoc($sql)
					
					?>
					<label class="col-sm-3 control-label">NIS</label>
					<div class="col-sm-3">
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
					<div class="col-sm-4">
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
					<div class="col-sm-4">
						<input type="text" id="date" name="tanggal_lahir" class="form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat Asal</label>
					<div class="col-sm-4">
						<textarea name="alamat_asal" class="form-control" placeholder="Alamat Asal"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat Sekarang</label>
					<div class="col-sm-4">
						<textarea name="alamat_sekarang" class="form-control" placeholder="Alamat Sekarang"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-4">
						<input type="number" name="no_telepon" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Pilih Jadwal</label>
					<div class="col-sm-9">
						<?php
						$sql = mysqli_query($koneksi, "SELECT a.*, b.nama_users
														FROM jadwal a
														LEFT JOIN users b
														ON a.id_guru=b.id ORDER BY nama_pelajaran DESC");
						?>
						<?php
						  while($row = mysqli_fetch_assoc($sql)){
						?>
							<div class="checkbox">
							  <label><input name="jadwal" type="checkbox" value="<?php echo $row['kode_jadwal'];?>"><?php echo $row['nama_pelajaran'];?> <?php echo $row['hari']; ?> <?php echo $row['jam']; ?> (<?php echo $row['nama_users']; ?>)</label>
							</div>
							
						<?php
						  }
						?>

					</div>
				</div>
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data mahasiswa">
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->



<?php 
include("footer.php"); // memanggil file footer.php
?>