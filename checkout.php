<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Belajar API Raja Ongkir</title>
  </head>
  <body>
    
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Subharga</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <form action="" method="post">
        <div class="form-group">
          <label for="provinsi">Provinsi</label>
          <select name="provinsi" id="provinsi" class="form-control">
          </select>
        </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="distrik">Distrik</label>
        <select name="distrik" id="distrik" class="form-control">
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="ekspedisi">Ekspedisi</label>
        <select name="ekspedisi" id="ekspedisi" class="form-control">
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="paket">Paket</label>
        <select name="paket" id="paket" class="form-control">
        </select>
      </div>
    </div>
    <input type="text" name="total_berat" value="1200" class="form-control">
    <input type="text" name="input_provinsi" class="form-control">
    <input type="text" name="input_distrik" class="form-control">
    <input type="text" name="input_tipe" class="form-control">
    <input type="text" name="input_kodepos" class="form-control">
    <input type="text" name="input_ekspedisi" class="form-control">
    <input type="text" name="input_paket" class="form-control">
    <input type="text" name="input_ongkir" class="form-control">
    <input type="text" name="input_estimasi" class="form-control">
      </form>
  </div>
</div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $.ajax({
          type: 'post',
          url: 'data_provinsi.php',
          success: function(hasil_provinsi) {
            $('select[name=provinsi]').html(hasil_provinsi);
          }
        });

        // data distrik
        $('select[name=provinsi]').on('change', function() {
          // ambil id_provinsi dari select provinsi yang di pilih (dari atribut pribadi)
          const id_provinsi_terpilih = $('option:selected',this).attr('id_provinsi');
          // alert(id_provinsi_terpilih);
          $.ajax({
            type: 'post',
            url: 'data_distrik.php',
            data: 'id_provinsi=' + id_provinsi_terpilih,
            success: function(hasil_distrik) {
              // console.log(hasil_distrik);
              $('select[name=distrik]').html(hasil_distrik);
            }
          });
        });

        // ekspedisi
        $.ajax({
          type: 'post',
          url: 'data_ekspedisi.php',
          success: function(hasil_ekspedisi) {
            // console.log(hasil_ekspedisi);
            $('select[name=ekspedisi]').html(hasil_ekspedisi);
          }
        });

        // ongkir
        $('select[name=ekspedisi]').on('change', function() {
          // mendapatkan ongkos kirim

          // mendapatkan ekspedisi yang dipilih
          const ekspedisi_terpilih = $('select[name=ekspedisi]').val();
          // alert(ekspedisi_terpilih);

          // mendapatkan id_distrik yang dipilih pengguna
          const disktrik_terpilih = $('option:selected', 'select[name=distrik]').attr('id_distrik');
          // alert(disktrik_terpilih);

          // mendapatkan total_berat dari inputan
          const total_berat = $('input[name=total_berat]').val();
          $.ajax({
            type: 'post',
            url: 'data_paket.php',
            data: 'ekspedisi='+ ekspedisi_terpilih +'&distrik='+ disktrik_terpilih +'&berat=' + total_berat,
            success: function(hasil_paket) {
              // console.log(hasil_paket);
              $('select[name=paket]').html(hasil_paket);

              // letakkan nama ekpedisi terpilih di input ekspedisi
              $('input[name=input_ekspedisi]').val(ekspedisi_terpilih);
            }
          });
        });

        // ketika inputan distrik klik pilih, atau nama kab/kota
        $('select[name=distrik]').on('change', function() {
          const prov = $('option:selected', this).attr('nama_provinsi');
          const dist = $('option:selected', this).attr('nama_distrik');
          const typ = $('option:selected', this).attr('tipe_distrik');
          const kodep = $('option:selected', this).attr('kodepos');
          // alert(prov);

          $('input[name=input_provinsi]').val(prov);
          $('input[name=input_distrik]').val(dist);
          $('input[name=input_tipe]').val(typ);
          $('input[name=input_kodepos]').val(kodep);
        });

        // ketika inputan paket/ongkir di klik & memilih pos, jne, tiki
        $('select[name=paket]').on('change', function() {
          const paket = $('option:selected', this).attr('paket');
          const ongkir = $('option:selected', this).attr('ongkir');
          const etd = $('option:selected', this).attr('etd');

          $('input[name=input_paket').val(paket);
          $('input[name=input_ongkir').val(ongkir);
          $('input[name=input_estimasi').val(etd);
        });
      });
    </script>
  </body>
</html>