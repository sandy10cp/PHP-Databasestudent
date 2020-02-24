<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
		<?php
			$nim = $_GET['nim']; // mengambil data nim dari nim yang terpilih
			
			$sql = mysqli_query($koneksi, "SELECT a . * , b . * 
											FROM mahasiswa a
											LEFT JOIN jadwal b ON a.jadwal_1 = b.kode_jadwal OR a.jadwal_2 = b.kode_jadwal OR a.jadwal_3 = b.kode_jadwal
											WHERE a.nim='$nim'"); // query memilih entri nim pada database
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_GET['aksi']) == 'delete'){ // jika tombol 'Hapus Data' pada baris 87 ditekan
				$delete = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'"); // query delete entri dengan nim terpilih
				if($delete){ // jika query delete berhasil dieksekusi
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
				}else{ // jika query delete gagal dieksekusi
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
				}
			}
			?>
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#">Profile</a></li>
		  <li><a href="nilai.php?nim=<?php echo $row['nim']; ?>">Nilai</a></li>
		  <li><a href="spp.php?nim=<?php echo $row['nim']; ?>">SPP</a></li>
		  <li><a href="#">Menu 3</a></li>
		</ul>
			<h2><a href="data.php">Data Student </a> &raquo; <?php echo $row['nama']; ?></h2>
			<hr />
			<!-- bagian ini digunakan untuk menampilkan data mahasiswa -->
			<table class="table table-striped table-condensed">
				<tr>
					<th width="20%">NIM</th>
					<td><?php echo $row['nim']; ?></td>
				</tr>
				<tr>
					<th>Nama mahasiswa</th>
					<td><?php echo $row['nama']; ?></td>
				</tr>
				<tr>
					<th>Jenis Kelamin</th>
					<td><?php echo $row['jenis_kelamin']; ?></td>
				</tr>
				<tr>
					<th>Tempat & Tanggal Lahir</th>
					<td><?php echo $row['tempat_lahir'].', '.$row['tanggal_lahir']; ?></td>
				</tr>
				<tr>
					<th>Alamat Asal</th>
					<td><?php echo $row['alamat_asal']; ?></td>
				</tr>
				<tr>
					<th>Alamat Sekarang</th>
					<td><?php echo $row['alamat_sekarang']; ?></td>
				</tr>
				<tr>
					<th>No Telepon</th>
					<td><?php echo $row['no_telepon']; ?></td>
				</tr>
				<tr>
					<th>Jadwal Pelajaran</th>
					<td>
					<?php
					$sql2 = mysqli_query($koneksi, "SELECT a . * , b . * , c. nama_users
													FROM mahasiswa a
													LEFT JOIN jadwal b ON a.jadwal_1 = b.kode_jadwal OR a.jadwal_2 = b.kode_jadwal OR a.jadwal_3 = b.kode_jadwal 
													LEFT JOIN users c ON b.id_guru = c.id
													WHERE a.nim='$nim'"); // query memilih entri nim pada database
					while($row2 = mysqli_fetch_assoc($sql2)){
					?>
					<table class="table table-striped table-hover">
					<tr>
					<td>
					<p><?php echo $row2['nama_pelajaran'].' => '.$row2['hari'].' => '.$row2['jam'].' => '.($row2['nama_users']); ?></p>
					</td>
					</tr>
					</table>
					<?php
					}
					?>
					</td>
				</tr>
				
			</table>
			<!-- memulai tabel responsive -->

			</div> <!-- /.table-responsive -->
			
			<a href="data.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</a>
			<a href="edit.php?nim=<?php echo $row['nim']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Data</a>
			<a href="profile.php?aksi=delete&nim=<?php echo $row['nim']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin akan mengahapus data <?php echo $row['nama']; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus Data</a>
		</div> <!-- /.content -->
	</div> <!-- /.container -->

<?php 
include("footer.php"); // memanggil file footer.php
?>