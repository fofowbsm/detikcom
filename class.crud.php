<?php
    class crud {
        private $db;
        function __construct($connect){
            $this->db = $connect;
        }

        public function create($tanggal, $judul, $isi, $penulis){
            try{
                $insert = $this->db->prepare("insert into portal_berita(tanggal,judul,isi,penulis) VALUES(:tanggal,:judul,:isi,:penulis)");
                $insert->bindparam(":tanggal",$tanggal);
                $insert->bindparam(":judul",$judul);
                $insert->bindparam(":isi",$isi);
                $insert->bindparam(":penulis",$penulis);

                $insert->execute();
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getID($id){
            $get_id = $this->db->prepare("SELECT * FROM portal_berita WHERE id=:id");
            $get_id->execute(array(":id"=>$id));
            $edit_row=$get_id->fetch(PDO::FETCH_ASSOC);
            return $edit_row;
        }

        public function update($id, $tanggal, $judul, $isi, $penulis){
            try{
                $update=$this->db->prepare("UPDATE portal_berita SET tanggal=:tanggal,judul=:judul, isi=:isi, penulis=:penulis WHERE id=:id ");
                $update->bindparam(":tanggal",$tanggal);
                $update->bindparam(":judul",$judul);
                $update->bindparam(":isi",$isi);
                $update->bindparam(":penulis",$penulis);

                $update->bindparam(":id",$id);
                $update->execute();

                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
                return false;
            }
        }
        public function delete($id)
        {
            $delete = $this->db->prepare("DELETE FROM portal_berita WHERE id=:id");
            $delete->bindparam(":id",$id);
            $delete->execute();
            return true;
        }
        public function upload(){
            if(isset($_POST['btn-upload']))
            {

                $file = rand(1000,100000)."-".$_FILES['file']['name'];
                $file_loc = $_FILES['file']['tmp_name'];
                $file_size = $_FILES['file']['size'];
                $file_type = $_FILES['file']['type'];
                $folder="uploads/";

                move_uploaded_file($file_loc,$folder.$file);
                $sql="INSERT INTO uploads(file,type,size) VALUES('$file','$file_type','$file_size')";
                mysql_query($sql);
            }
        }

// PAAAAAAAAAAAAAAAAAAAAAAAAGGGGGGGGGGGGGGGGGIIIIIIIIIIIIIIIIIIIIIIIINNNNNNNNNNNNNNNNNNNNNGGGGGGGGGGGGGGGGGGGGGGGGGGG //

    public function dataview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0){
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['tanggal']); ?></td>
                    <td><?php print($row['judul']); ?></td>
                    <td><?php print($row['isi']); ?></td>
                    <td><?php print($row['penulis']); ?></td>

                    <td align="center">
                        <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
            <?php
            }
        }
        else{
            ?>
            <tr>
                <td>Nothing here...</td>
            </tr>
        <?php
        }

    }

    public function paging($query,$records_per_page)
    {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query,$records_per_page){

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if($total_no_of_records > 0)
        {
            ?><ul class="pagination"><?php
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            $current_page=1;
            if(isset($_GET["page_no"]))
            {
                $current_page=$_GET["page_no"];
            }
            if($current_page!=1)
            {
                $previous =$current_page-1;
                echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for($i=1;$i<=$total_no_of_pages;$i++)
            {
                if($i==$current_page)
                {
                    echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                }
                else
                {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if($current_page!=$total_no_of_pages)
            {
                $next=$current_page+1;
                echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
            }
            ?></ul><?php
        }
    }

    /* paging */
}