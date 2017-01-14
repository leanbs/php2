<!DOCTYPE html>
<html>
<head>
	<title>Laporan Inventori</title>
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
		<h3 style="text-align : right;">Laporan Inventori Bulanan</h3>
		<h4 style="text-align : right;">Untuk Periode Yang Berakhir Bulan: <?php echo(date('F Y'));?></h4>
	</div>
</header>
<hr/>
	<div style="overflow-x:auto;">
		<table>
			<thead>
			<tr>
				<th>No</th>
				<th>Tipe Barang</th>
				<th>Merk</th>
				<th>Kategori</th>
				<th>Harga Barang</th>
				<th>Jumlah</th>
			</tr>
			</thead>
			<tbody><?php $no = 0 ?>
				@foreach($inventori as $key => $inventori)
				<tr><?php $no++ ?>
					<td>{{ $no }}
					<td>{{ $inventori->tipe_brg }}</td>
					<td>{{ $inventori->merk }}</td>
					<td>{{ $inventori->kategori }}</td>
					<td>{{ number_format($inventori->harga_barang, 2, ",", ".") }}</td>
					<td>{{ $inventori->jumlah }}</td>
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