<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
		<?php
		$nim = $_GET['nim']; // mengambil data nim dari nim yang terpilih
		
		?>
		<ul class="nav nav-tabs">
		  <li><a href="profile.php?nim=<?php echo $nim ?>">Profile</a></li>
		  <li><a href="nilai.php?nim=<?php echo $nim ?>">Nilai</a></li>
		  <li class="active"><a href="#">SPP</a></li>
		  <li><a href="#">Menu 3</a></li>
		</ul>
			<h2><a href="data.php">Data Student </a> &raquo; SPP Student</h2>
			<hr />
			<div class="container">
			<table class="table table-striped">
			        <th>No</th>
					<th>Tanggal Pembayaran</th>
					<th>Jumlah</th>
					<th>Keterangan</th>
			<?php
			$sql3 = mysqli_query($koneksi, "SELECT * FROM spp WHERE kode_nis='$nim' order by tgl_input DESC");
			if(mysqli_num_rows($sql3) == 0){ 
				echo '<tr><td colspan="14">Data SPP Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
			}else{
				$no=1;
				  while($row3 = mysqli_fetch_assoc($sql3)){
				?>
			   
				<tr>
				<td><?php echo $no ?>
				<td><?php echo $row3['tgl_input']; ?></td>
				<td>Rp <?php echo number_format($row3['jumlah'], 0, ".","."); ?></td>
				<td><?php echo $row3['keterangan']; ?></td>
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