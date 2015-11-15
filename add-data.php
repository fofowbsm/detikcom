<?php
include_once 'config.php';
if(isset($_POST['btn-save']))
{
    $tanggal = $_POST['tanggal'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];


    if($crud->create($tanggal,$judul,$isi,$penulis))
    {
        header("Location: add-data.php?inserted");
    }
    else
    {
        header("Location: add-data.php?failure");
    }
}
?>
<?php include_once 'header.php'; ?>
    <div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
    ?>
    <div class="container">
        <div class="alert alert-info">
            <strong>OK!</strong> Tambah Berita Berhasil<a href="index.php">HOME</a>!
        </div>
    </div>
<?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>SORRY!</strong> ERROR !
        </div>
    </div>
<?php
}
?>

    <div class="clearfix"></div><br />

    <div class="container">


        <form method='post'>

            <table class='table table-bordered'>

                <tr>
                    <td>Tanggal</td>
                    <td><input type='date' name='tanggal' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Judul</td>
                    <td><input type='text' name='judul' class='form-control' required></td>
                </tr>

                <tr>
                    <td>ISI</td>
                    <td><textarea name="isi" class='form-control' required>Enter text here...</textarea></td>
                </tr>

                <tr>
                    <td>Penulis</td>
                    <td>
                        <div class="form-group">
                            <select class="form-control" id="penulis" name="penulis">
                                <option>popow</option>
                                <option>wopop</option>
                                <option>saiknam</option>
                                <option>faris</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary" name="btn-save">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Berita Baru!
                        </button>
                        <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
                    </td>
                </tr>

            </table>
        </form>


    </div>

<?php include_once 'footer.php'; ?>