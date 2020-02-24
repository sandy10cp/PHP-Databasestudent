<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
<head>
	<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script> 
<style>
        .tt-hint,
        .caristudent {
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 40px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 350px;
        }

        .tt-dropdown-menu {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }
    </style>
	<script>
		$(document).ready(function() {

				$('input.caristudent').typeahead({
				name: 'caristudent',
				remote: 'carinama.php?query=%QUERY'

			});

		})
	</script>

</head>
	<div class="container">
		<div class="content">
			<h2>Input Data SPP</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add" pada baris 164 ditekan
				$caristudent	= $_POST['caristudent'];
				$tgl_input		= $_POST['tgl_input'];
				$jumlah   		= $_POST['jumlah'];
				$keterangan	 	= $_POST['keterangan'];
				
				$arr_kalimat = explode(", ",$caristudent);
				$str = $arr_kalimat[1];
				
				$insert = mysqli_query($koneksi, "INSERT INTO spp(kode_nis, tgl_input, jumlah, keterangan) VALUES('$str','$tgl_input', '$jumlah', '$keterangan')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data SPP Berhasil Di Simpan. <a href="input_spp.php"><- Kembali</a></div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data SPP Gagal Di simpan! <a href="input_spp.php"><- Kembali</a></div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}
			}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
				<label class="col-sm-3 control-label">NIS</label>
				<div class="col-sm-3">
						<input type="text" id="caristudent" name="caristudent" placeholder="Cari Nama Student" class="caristudent">
				</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Input</label>
					<div class="col-sm-3">
						<input type="text" id="date" name="tgl_input" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jumlah</label>
					<div class="col-sm-4">
						<input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Keterangan</label>
					<div class="col-sm-3">
						<textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
					</div>
				</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data SPP">
						<a href="input_spp.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>
