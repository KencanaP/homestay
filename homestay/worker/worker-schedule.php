<?php include('layout/header.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Worker Schedule </h1>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('layout/footer.php'); ?>