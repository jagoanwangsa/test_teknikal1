<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Produk Data</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Produk Barang</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Table Stok Barang</a></li>
    </ul>
  </div>
</nav>

<div style="margin-left:80%;">
	<a href="<?php echo base_url();?>index.php/formtambah"><button type="button" class="btn btn-primary">Tambah Data</button></a>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nama Barang</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>

  
<?php   foreach($product as $row){ ?>


  <tbody>
    <tr>
      <td> <?=$row['namabarang'];?></td>  
	  <td><?="Rp ".number_format($row['hargabeli'], 2, ",", ".");?></td>
	  <td> <?="Rp ".number_format($row['hargajual'], 2, ",", ".");?></td>
	  <td><a  href="<?php echo base_url();?>index.php/detaildata/<?=$row['idbarang'];?>">Detail</a></td>
	  <td>  <a    href="javascript:void(0);"onclick="confirmationdelete(<?=$row['idbarang'];?>);">Delete</a></td>
    </tr>
  </tbody>

  <?php   } ?>
</table>



</body>
</html>
