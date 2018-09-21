<!DOCTYPE html>
<head>
    <title>Edit Postingan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <?php
      include_once("../config/Functions.php");
      $functions = new Functions();
      $id = $_GET['id'];
      $resultEdit = $functions->editpost($id);

      while($row = $query->fetchAll(PDO::FETCH_ASSOC))
      {
        $title = $row['title'];
        $desc = $row['desc'];
        $postedDate = $row['postedDate'];
        $postedBy = $row['postedBy'];
      }
   ?>
    <div id="donasi-contact" class="container-fluid" style="max-width: 700px;">
         <div class="col-sm-12" id="style-background">
            <h2 class="text-cap text-center" style="margin-top:20px;">Edit Post</h2>
            <form id="form-group" name="update_user" action="" method="post" style=" font-family: sans-serif; font-weight: 500; margin-top: 45px;" id="myForm" action="#" method="POST" onSubmit="validasi()">
              <div class="form-group">
                <label style="color: black">Judul</label>
                <textarea name="title" class="form-control" id="pesan" rows="1" style="height: 100px;"><?= $judul;?></textarea>
              </div>
              <div class="form-group">
                <label style="color: black">Isi</label>
                <textarea name="desc" class="form-control" id="pesan" rows="3" style="height: 100px;"><?= $isi;?></textarea>
              </div>
              <div class="form-group">
                <label style="color: black">Tanggal</label>
                <textarea name="postedDate" class="form-control" id="pesan" rows="1" style="height: 100px;"><?= $date;?></textarea>
              </div>
            <div class="form-group">
              <label style="color: black">Author</label>
              <textarea name="postedBy" class="form-control" id="pesan" rows="1" style="height: 100px;"><?= $author;?></textarea>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <input type="hidden" name="id" value=<?= $_GET['id'];?>>
                <input type="submit" name="update" class="btn btn-primary" style="font-weight: 600;" value="Simpan">
              </div>
            </div>
          </form>
        </div>
    </div>

    <?php
      // if (isset($_POST['update'])) {
      //   $resultCreate = $functions->editpost($_POST["title"],$_POST["desc"],$_POST["postedDate"],$_POST["postedBy"]);
      //   }
      ?>
  </body>
</html>
