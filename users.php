<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>

		<?php
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add"
				$nama_users		     = $_POST['nama_users'];
				$username		     = $_POST['username'];
				$password   = $_POST['password'];
				$akses	 = $_POST['akses'];
				
				$insert = mysqli_query($koneksi, "INSERT INTO users(nama_users, username, password, akses) VALUES('$nama_users','$username', '$password', '$akses')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data User Berhasil Di Simpan.</div>'; // maka tampilkan 'Data User Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data User Gagal Di simpan!</div>'; // maka tampilkan 'Ups, Data User Gagal Di simpan!'
						}
			}
			?>
			
	<div class="container">
		<div class="content">
			<h2>Manage Users</h2>
			<hr />
			<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add User </button>
				</div> <!-- /div-action -->
			<br />
			<br/>
			<br/>
			<!-- memulai tabel responsive -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>Nama Users</th>
						<th>Username</th>
						<th>Akses</th>
						<th>Tools</th>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "SELECT * FROM users"); // jika tidak ada filter maka tampilkan semua entri
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['nama_users'].'</td>
								<td>'.$row['username'].'</td>
								<td>'.$row['akses'].'</td>';
								echo '
								</td>
								<td>
									
									<a href="edit_user.php?id='.$row['id'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="password.php?nim='.$row['id'].'" title="Ganti Password" data-toggle="tooltip" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
									<a href="index.php?aksi=delete&nim='.$row['id'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama_users'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
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
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
	      </div>

	      <!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama User</label>
					<div class="col-sm-5">
						<input type="text" name="nama_users" class="form-control" placeholder="Nama User" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-4">
						<input type="text" name="username" class="form-control" placeholder="Username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-4">
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Akses</label>
					<div class="col-sm-4">
						<select name="akses" class="form-control" required>
							<option value="">-----</option>
							<option value="Teacher">Teacher</option>
							<option value="Kepalasekolah">Kepalasekolah</option>
						</select>
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