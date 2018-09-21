<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>

    <?php
      include_once("../header.php");
    ?>
    <div id="donasi-contact" class="container-fluid" style="max-width: 700px;">
         <div class="col-sm-12" id="style-background">
            <h2 class="text-cap text-center" style="margin-top:20px;">Tambah Post</h2>
            <form id="form-group" method="post" style=" font-family: sans-serif; font-weight: 500; margin-top: 45px;" id="myForm" action="#" method="POST" onSubmit="validasi()">
              <div class="form-group">
                <label style="color: black">Judul</label>
                <input align="center" name="title" type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label style="color: black">Isi</label>
                <textarea name="desc" class="form-control" id="pesan" rows="3" style="height: 100px;"></textarea>
              </div>
              <div class="form-group">
                <label style="color: black">Tanggal</label>
                <input type="date" name="postedDate" class="form-control" id="email" >
              </div>
            <div class="form-group">
              <label style="color: black">Author</label>
              <input type="text" name="postedBy" class="form-control" id="email" >
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" name="Submit" class="btn btn-primary" style="font-weight: 600;" value="Tambah">
              </div>
            </div>
          </form>
        </div>
    </div>

    <?php
      if (isset($_POST['Submit'])) {
        $resultCreate = $functions->createpost($_POST['title'],$_POST['desc'],$_POST['postedDate'],$_POST['postedBy']);
        }
      ?>
  </body>
</html>
