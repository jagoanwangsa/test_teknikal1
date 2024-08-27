<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Produk Barang</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<?php   foreach($detail_data as $row){ ?>


    <script type="text/javascript">

        $(document).ready(function() {
          
          document.getElementById("tempimageuploadgambar").innerHTML = '<input type="hidden" id="tempvaluegambarstok" name="tempvaluegambarstok" value='+"<?php  echo $row['gambarbarang'];?>"+'>';
          

          document.getElementById("flaggantigambar").innerHTML = '<input type="hidden" id="valuegantigambar" value=0>';
          $("#gambarbaru").hide();

          document.getElementById("tempubahbeli").innerHTML = '<input type="hidden" id="temp_value_ubah_beli" name="temp_value_ubah_beli" value=0>';


            document.getElementById("tempubahjual").innerHTML = '<input type="hidden" id="temp_value_ubah_jual" name="temp_value_ubah_jual" value=0>';


            var texthargabeli = document.getElementById('texthargabeli');
            texthargabeli.addEventListener('keyup', function(e){

                document.getElementById("tempubahbeli").innerHTML = '<input type="hidden" id="temp_value_ubah_beli" name="temp_value_ubah_beli" value=1>';
              
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                texthargabeli.value = formatRupiah(this.value, 'Rp. ');
            });


            var texthargajual = document.getElementById('texthargajual');
            texthargajual.addEventListener('keyup', function(e){
              document.getElementById("tempubahjual").innerHTML = '<input type="hidden" id="temp_value_ubah_jual" name="temp_value_ubah_jual" value=1>';

                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                texthargajual.value = formatRupiah(this.value, 'Rp. ');
            });
 
 
            $('input.floatNumber').on('input', function() {
                this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1');
            });

        });

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

        function uploadimagestruk(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					//$('#falseinput').attr('src', e.target.result);
					//$('#base').val(e.target.result);
                    //alert(e.target.result);
                    document.getElementById("tempimageuploadgambar").innerHTML = '<input type="hidden" id="tempvaluegambarstok" name="tempvaluegambarstok" value='+e.target.result+'>';
                    
				};
				reader.readAsDataURL(input.files[0]);
			}
		}

        window.addEventListener('load', function() {
            document.querySelector('input[type="file"]').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var img = document.querySelector('img');
            img.onload = () => {
              URL.revokeObjectURL(img.src);
          }
          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
          
            }
          });
      });

      function post_to_url(url, obj) {
            let id=`form_${+new Date()}`;
            document.body.innerHTML+=`
                <form id="${id}" action="${url}" method="POST">
                ${Object.keys(obj).map(k=>`
                    <input type="hidden" name="${k}" value="${obj[k]}">
                `)}
                </form>`
            this[id].submit();  
      }

      function editdata() {

        var textnamabarang =(document.getElementById("textnamabarang").value); 

        var texthargabeli =(document.getElementById("texthargabeli").value); 

        var texthargajual =(document.getElementById("texthargajual").value); 


        var temp_value_ubah_beli =(document.getElementById("temp_value_ubah_beli").value); 

        var valuegantigambar =(document.getElementById("valuegantigambar").value); 

        var convertnumberhargabeli;

        var convertnumberhargajual;

        if(temp_value_ubah_beli == "0")

        {
            var converthargabeli = texthargabeli.replace("Rp", "");


            var converthargabeli2 = converthargabeli.replace(".", "");

            var converthargabeli3 = converthargabeli2.replace(",00", "");
        
            convertnumberhargabeli = parseInt(converthargabeli3);
        }

        
        else if(temp_value_ubah_beli == "1")

        {
   
          var converthargabeli = texthargabeli.replace("Rp.", "");

          var converthargabeli2 = converthargabeli.replace(".", "");
          

          convertnumberhargabeli = parseInt(converthargabeli2);

        }

        var temp_value_ubah_jual =(document.getElementById("temp_value_ubah_jual").value); 

        if(temp_value_ubah_jual == "0")

          {
              var converthargajual = texthargajual.replace("Rp", "");


              var converthargajual2 = converthargajual.replace(".", "");

              var converthargajual3 = converthargajual2.replace(",00", "");

              convertnumberhargajual = parseInt(converthargajual3);
          }


          else if(temp_value_ubah_jual == "1")

          {

            var converthargajual = texthargajual.replace("Rp.", "");

            var converthargajual2 = converthargajual.replace(".", "");
            

            convertnumberhargajual = parseInt(converthargajual2);

          }


          var inputgambar =(document.getElementById("tempvaluegambarstok").value); 

          var texttambahstok =(document.getElementById("texttambahstok").value); 

          var convertstokbarang = parseInt(texttambahstok);
          



          post_to_url(
          '<?php echo base_url();?>index.php/formedit', {'flaggantigambar': valuegantigambar,'idbarang':<?php  echo $row['idbarang'];?> ,'textnamabarang':textnamabarang,'convertnumberhargabeli':convertnumberhargabeli, 'convertnumberhargajual':convertnumberhargajual, 'inputgambar' :inputgambar, 'convertstokbarang':convertstokbarang });


      }

     function ubahgambar() {

      $("#gambarbaru").show();
      $("#detailgambar").hide();
      $("#buttongambar").hide();
      document.getElementById("flaggantigambar").innerHTML = '<input type="hidden" id="valuegantigambar" value=1>';
     }

	</script>


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

<div>

<a href="<?php echo base_url();?>" >Kembali</a>
      
</div>
<br>




<form>
  <div class="form-group">
    <label for="labelnamabarang">Nama Barang</label>
    <input type="text" class="form-control" id="textnamabarang" name="textnamabarang" value = "<?=$row['namabarang'];?>" placeholder="masukan nama barang">
  </div>
  <div class="form-group">
        <label for="labelnamabarang">Harga Beli</label>
       <input type="text" class="form-control"  id="texthargabeli" name="texthargabeli" value="<?="Rp ".number_format($row['hargabeli'], 2, ",", ".");?>" placeholder="masukan harga beli"/>
  </div>
  <div class="form-group">
      <label for="labelnamabarang">Harga Jual</label>
      <input type="text" class="form-control"  id="texthargajual" name="texthargajual" value="<?="Rp ".number_format($row['hargajual'], 2, ",", ".");?>" placeholder="masukan harga jual"/>
  </div>
  <div id="tempubahbeli"class="form-group">
  </div>
  <div id="tempubahjual"class="form-group">
  </div>

  <div class="form-group">
    <label for="labelnamabarang">Stok Barang</label>
    <input type="text" class="form-control floatNumber" id="texttambahstok" name="texttambahstok" value ="<?=$row['stok'];?>" placeholder="masukan stok barang">
  </div>
    <div id="tempimageuploadgambar">
    </div>
    <div id="flaggantigambar">
    </div>
  <div id="gambarbaru" class="form-group">
        <label for="labelfotobarang">Foto Barang</label>
        <input id="fileinput" type="file" onchange="uploadimagestruk(this);" /> <br><br>
        <img id="myImg" src="<?php echo base_url();?>gambar/no_image.jpg" width="60%">
  </div>
  <div id = "detailgambar" class="form-group">
  <label for="labelfotobarang">Foto Barang</label>
  <br>
    <img src="<?php echo base_url($row['gambarbarang']);?>" width="60%">
  </div>



  <div class="form-group">
    <button id = "buttongambar" type="button" onclick="ubahgambar();" class="btn btn-danger btn-lg btn-block">Ganti Gambar</button>
  </div>

  <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="editdata();">Simpan</button>


</form>

<?php } ?>


</body>
</html>
