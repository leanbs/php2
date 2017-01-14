<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
	<style type="text/css">
		header {
		    width: 100%;
		    margin: auto;
		    padding: 10px;
		}
		div#one {
		    width: 15%;
		    float: left;
		}
		div#two {
		    margin-left: 15%;
		}
		table {
		    border-collapse: collapse;
		    width: 100%;
		}
		th, td {
			border: 1px solid #000000;
		    text-align: left;
		    padding: 8px;
		}
		tbody tr:nth-child(odd) td   { background-color:#f5f5f5; }
		tbody tr:nth-child(even) td   { background-color:#a3a3c2; }
		thead tr th { background-color: #00e600 }
	</style>
</head>
<body>
<header>
	<div id="one">
		<img class="brand-image" alt="Brand" src="http://davinyi.com/metro/assets/img/logo-header-metro.png" width="350px">
	</div>
	<div id="two">
		<!-- <h3 style="text-align : center;">Metro Elektronik </h3> -->
		<h3 style="text-align : right;">Laporan Transaksi Bulanan</h3>
		<h4 style="text-align : right;">Untuk Periode Yang Berakhir Bulan: <?php echo(date('F Y'));?></h4>
	</div>
</header>
<hr/>
	<div style="overflow-x:auto;">
		<table>
			<thead>
			<tr>
				<th>No Nota</th>
				<th>Jenis Transaksi</th>
				<th>Nama Pelanggan</th>
				<th>Alamat</th>
				<th>Nomor Telepon</th>
				<th>Tanggal Transaksi</th>
				<th>Nama Karyawan</th>
				<th>Status Bayar</th>
				<th>Status Kirim</th>
			</tr>
			</thead>
			<tbody>
				@foreach($transaksi as $key => $transaksi)
				<tr>
					<td>{{ $transaksi->id_transaksi }}</td>
					<td>
						@if($transaksi->id_jenis_transaksi=="1")
							Penjualan
						@elseif($transaksi->id_jenis_transaksi=="2")
							Pembelian
						@else
							Lain-Lain
						@endif
					</td>
					<td>{{ $transaksi->nama_pelanggan }}</td>
					<td>{{ $transaksi->alamat }}</td>
					<td>{{ $transaksi->nomor_telp }}</td>
					<td>{{ $transaksi->tanggal_transaksi }}</td>
					<td>{{ $transaksi->nama_karyawan }}</td>
					<td>
						@if($transaksi->status_bayar=="0")
							Sudah
						@elseif($transaksi->status_bayar=="1")
							Belum
						@else
							Lain-Lain
						@endif
					</td>
					<td>
						@if($transaksi->status_kirim=="0")
							Sudah
						@elseif($transaksi->status_kirim=="1")
							Belum
						@else
							Lain-Lain
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div style="text-align: right;">
		<p><?php echo(date('d F Y'));?></p>
	</div>

</body>
</html>