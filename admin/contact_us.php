<?php
    require 'header.inc.php';
    $sql = "SELECT * FROM categories ORDER BY categories ASC";
    $result = mysqli_query($conn, $sql);

    if(isset($_GET['type']) && $_GET['type'] != '') {
        $type = $_GET['type']; // Assigning the value from $_GET['type'] to $type variable
        if($type == 'delete') {
            $id = get_safe_value($conn, $_GET['id']);
            
            $sql_delete = "DELETE FROM contact_us WHERE id='$id'";
            mysqli_query($conn, $sql_delete);
        }
    }
    
    $sql = "SELECT * FROM contact_us ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title"> Contact us </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">S.No</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($result)) {?>
                                        <tr>
                                            <td class="serial"><?php echo $i?></td>
                                            <td><?php echo $row['id']?></td>
                                            <td><?php echo $row['name']?></td>
                                            <td><?php echo $row['email']?></td>
                                            <td><?php echo $row['mobile']?></td>
                                            <td><?php echo $row['comment']?></td>
                                            <td><?php echo $row['added_on']?></td>
                                            <td>
                                                <?php
                                                    // echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>&nbsp"; //delete user comment button
                                                    echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>&nbsp";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require 'footer.inc.php';
?>