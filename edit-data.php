<?php
include_once 'config.php';
if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $tanggal = $_POST['tanggal'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];

    if($crud->update($id,$tanggal, $judul, $isi, $penulis))
    {
        $msg = "<div class='alert alert-info'>
    <strong>OK!</strong> Record was updated successfully <a href='index.php'>HOME</a>!
    </div>";
    }
    else
    {
        $msg = "<div class='alert alert-warning'>
    <strong>KO!</strong> ERROR while updating record !
    </div>";
    }
}

if(isset($_GET['edit_id']))
{
    $id = $_GET['edit_id'];
    extract($crud->getID($id));
}

?>
<?php include_once 'header.php'; ?>

    <div class="clearfix"></div>

    <div class="container">
        <?php
        if(isset($msg))
        {
            echo $msg;
        }
        ?>
    </div>

    <div class="clearfix"></div><br />

    <div class="container">
        <form method='post'>
            <table class='table table-bordered'>

                <tr>
                    <td>Tanggal</td>
                    <td><input type='date' name='tanggal' class='form-control' value="<?php echo $tanggal; ?>" required></td>
                </tr>

                <tr>
                    <td>Judul</td>
                    <td><input type='text' name='judul' class='form-control' value="<?php echo $judul; ?>" required></td>
                </tr>

                <tr>
                    <td>Isi</td>
                    <td><input type='text' name='isi' class='form-control' value="<?php echo $isi; ?>" required></td>
                </tr>

                <tr>
                    <td>Penulis</td>
                    <td>
                        <div class="form-group">
                            <select class="form-control" id="penulis" name="penulis">
                                <option><?php echo $penulis; ?></option>
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
                        <button type="submit" class="btn btn-primary" name="btn-update">
                            <span class="glyphicon glyphicon-edit"></span>  Update this Record
                        </button>
                        <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                    </td>
                </tr>

            </table>
        </form>


    </div>

<?php include_once 'footer.php'; ?>