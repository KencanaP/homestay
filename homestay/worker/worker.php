<?php include('layout/header.php'); ?>
<?php include('db-connection.php');

$query = "

SELECT 
    inventory.id,
    inventory.item_name,
    inventory.item_desc,
    inventory.img,
    inventory.qty,
    inventory.created_at,
    inventory.category_id,
    category.name AS category_name
FROM 
    inventory
JOIN 
    category ON inventory.category_id = category.id

    ";
$result = mysqli_query($conn, $query);

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Worker Section </h1>
            <!--ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">This is the worker page where worker able to see their prodile, schedule and apply leave</li>
            </ol>-->

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <a href="worker-profile.php" class="btn btn-light">Profile</a>
                            <a href="worker-schedule.php" class="btn btn-light">Worker Schedule</a>
                            <a href="worker-leave.php" class="btn btn-light">Leave Application</a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Date</th>
                                        <th>House ID</th>
                                        <th>Task</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th>Date</th>
                                        <th>House ID</th>
                                        <th>Task</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($result as $r): ?>
                                        <tr>
                                            <td><?php echo $r['sn_no']; ?></td>
                                            <td><?php echo $r['item_name']; ?></td>
                                            <td><?php echo $r['item_desc']; ?></td>
                                            <td>
                                                <?php if (!empty($r['img'])) { ?>
                                                    <a href="/inventory-system/<?php echo $r['img']; ?>" target="_blank"><u>Click Here for The Img</u></a>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $r['category_name']; ?></td>
                                            <td><?php echo $r['qty']; ?></td>
                                            <td><?php echo $r['created_at']; ?></td>
                                            <td>
                                                <a href="/inventory-system/edit-inventory.php?id=<?php echo $r['id']; ?>" class="btn btn-warning">Edit</a>
                                                <a href="/inventory-system/delete-inventory.php?id=<?php echo $r['id']; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include('layout/footer.php'); ?>