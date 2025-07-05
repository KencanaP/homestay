<?php include('layout/header.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Worker Profile </h1>
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
                                <p><span class="label">NAME</span>:  </p>
                                <p><span class="label">ID</span>: </p>
                                <p><span class="label">EMAIL</span>: </p>
                                <p><span class="label">AGE</span>: </p>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?= $worker['name']; ?>
        <?= $worker['id']; ?>
        <?= $worker['email']; ?>
        <?= $worker['age']; ?>

    </main>
    <?php include('layout/footer.php'); ?>