<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Change Password &raquo; Edit Password</h2>
			<hr />
			
			<?php
			$id = $result['id']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'"); // query untuk memilih entri data dengan nilai nim terpilih
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save"
				$username	= $_POST['username'];
				$curpassword   = $_POST['curpassword'];
				$newpassword   = $_POST['newpassword'];
				$conpassword   = $_POST['conpassword'];
				
				
				if($curpassword == $row['password']) {

					if($newpassword == $conpassword) {

						$updateSql = "UPDATE users SET username='$username', password = '$newpassword' WHERE id = {$id}";
						if($koneksi->query($updateSql) === TRUE) {
							$valid['success'] = true;
							$valid['messages'] = "Successfully Updated";
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Berhasil di ganti</div>'; // maka tampilkan 'Data berhasil disimpan.'
						} else {
							$valid['success'] = false;
							$valid['messages'] = "Error while updating the password";
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password gagal di ganti</div>';
						}

					} else {
						$valid['success'] = false;
						$valid['messages'] = "New password does not match with Conform password";
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New password tidak sama dengan Confirm password</div>';
					}

				} else {
					$valid['success'] = false;
					$valid['messages'] = "Current password is incorrect";
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Current password salah</div>';
				}
			}
				
				
				
				/*
				
				$update = mysqli_query($koneksi, "UPDATE users SET username='$username', password='$password' WHERE id='$id'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: users.php?pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="users.php"><- Kembali</a></div>'; // maka tampilkan 'Data berhasil disimpan.'
			}
			*/
			?>
			<!-- bagian ini merupakan bagian form untuk mengupdate data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Users</label>
					<div class="col-sm-2">
						<input type="text" name="nama_users" value="<?php echo $row ['nama_users']; ?>" class="form-control" placeholder="nama_users" readonly required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-4">
						<input type="text" name="username" value="<?php echo $row ['username']; ?>" class="form-control" placeholder="Username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Current Password</label>
					<div class="col-sm-4">
						<input type="Password" name="curpassword" value="" class="form-control" placeholder="Current Password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">New Password</label>
					<div class="col-sm-4">
						<input type="Password" name="newpassword" value="" class="form-control" placeholder="New Password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Conform Password</label>
					<div class="col-sm-4">
						<input type="Password" name="conpassword" value="" class="form-control" placeholder="Confrim Password" required>
					</div>
				</div>
				
				<!--<div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-2">
						<input type="text" name="username" value="<?php //echo $row['username']; ?>" class="form-control" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass1" value="<?php //echo $row['password']; ?>" class="form-control" placeholder="Password">
					</div>
				</div>-->
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Change Password">
						<a href="cpassword.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form>
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>