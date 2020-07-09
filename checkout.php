<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Hello, world!</title>
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
    <div class="col-md-4">
      <h3>Alamat</h3>
      <form action="" method="post">
        <div class="form-group">
          <label for="provinsi">Provinsi</label>
          <select name="provinsi" id="provinsi" class="form-control">
          </select>
        </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="distrik">Distrik</label>
        <select name="distrik" id="distrik" class="form-control">
          
        </select>
      </div>
    </div>
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
      });
    </script>
  </body>
</html>