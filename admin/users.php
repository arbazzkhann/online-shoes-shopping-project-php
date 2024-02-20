<?php
    require 'header.inc.php';

    if(isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($conn, $_GET['type']);
        if($type == 'delete') {
            $id = get_safe_value($conn, $_GET['id']);
            
            $sql_delete = "delete from users where id='$id'";
            mysqli_query($conn, $sql_delete);
        }
    }

    $sql = "SELECT * FROM users ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title"> Users </h4>
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
                                        <th>Password</th>
                                        <th>Mobile</th>
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
                                            <td><?php echo $row['password']?></td>
                                            <td><?php echo $row['mobile']?></td>
                                            <td><?php echo $row['added_on']?></td>
                                            <td>
                                                <?php
                                                    echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>&nbsp"; //delete category button
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