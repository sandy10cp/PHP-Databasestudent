<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Jadwal</h2>
			<hr />
			<?php
			if($result['akses'] == 'Kepalasekolah'){
				echo'
				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Jadwal</button>
				</div> <!-- /div-action -->
				';
			}
			
			?>
			<br />
			<br/>
			<br/>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
			        <th>No</th>
					<th>Kode Jadwal</th>
					<th>Kode Pelajaran</th>
					<th>Nama Pelajaran</th>
					<th>Hari</th>
					<th>Jam</th>
					<th>Teacher</th>
					<th>Tools</th>
			<?php
			$sql3 = mysqli_query($koneksi, "SELECT a.*, b.nama_users
											FROM jadwal a
											LEFT JOIN users b
											ON a.id_guru=b.id
											ORDER BY a.nama_pelajaran ASC;");
			if(mysqli_num_rows($sql3) == 0){ 
						echo '<tr><td colspan="14">Data Nilai Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ 
			$no=1;					
				  while($row3 = mysqli_fetch_assoc($sql3)){
				?>
							<tr>
				            <td><?php echo $no ?>
				            <td><?php echo $row3['kode_jadwal']; ?></td>
				            <td><?php echo $row3['kode_pelajaran']; ?></td>
							<td><?php echo $row3['nama_pelajaran']; ?></td>
				            <td><b><?php echo $row3['hari']; ?></b></td>
							<td><?php echo $row3['jam']; ?></td>
							<td><?php echo $row3['nama_users']; ?></td>
							<?php
							if($result['akses']=='Kepalasekolah'){
								echo'
								<td>
									<a href="edit_jadwal.php?id='.$row3['id'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="jadwal.php?aksi=delete&id='.$row3['id'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row3['kode_jadwal'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
									';
								}else{
									
								}
							?>
				            </tr>
							<?php
					     $no++;
						}
					}
				?>
			   
			</table>
		</div>
	</div> <!-- /.content -->
	</div> <!-- /.container -->

<?php 
include("footer.php"); // memanggil file footer.php
?>