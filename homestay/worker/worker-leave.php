<?php include('layout/header.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Worker Leave Application </h1>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <a href="worker-profile.php" class="btn btn-light">Profile</a>
                            <a href="worker-schedule.php" class="btn btn-light">Worker Schedule</a>
                            <a href="worker-leave.php" class="btn btn-light">Leave Application</a>
                        </div>
                        <div class="container-fluid px-4">
                            <form class="mt-4">
                                <div class="form-group">
                                    <label for="snNo">Worker ID</label>
                                    <input type="text" class="form-control" id="snNo" name="sn_no" placeholder="Enter Item Name">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="itemName">Worker Name</label>
                                    <input type="text" class="form-control" id="itemName" name="item_name" placeholder="Enter Item Name">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="category_id">Leave Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>

                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="itemDesc">Reason For Leave (Please attach mc if have)</label>
                                    <textarea class="form-control" name="item_desc" id="itemDesc" placeholder="Enter Item Desc"></textarea>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="row">
                                        <div class="col" style="max-width: 200px;">
                                            <input type="text" class="form-control" placeholder="Start Date">
                                        </div>
                                        <div class="col" style="max-width: 200px;">
                                            <input type="text" class="form-control" placeholder="End Date">
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                <br>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('layout/footer.php'); ?>