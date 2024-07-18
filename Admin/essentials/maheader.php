<?php require("urlcheck.php"); ?>


<div class="container-fluid bg-dark text-light p-4 d-flex align-items-center justify-content-between sticky-top">
    <h1 class="m-0">Main Admin</h1>
    <a href="logout.php" class="btn btn-light btn-sm">Log out</a>
</div>

    <div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid flex-lg-column align-items-stretch">
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDrop" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDrop">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (comparePage() == 'madashboard.php') ? 'active' : ''; ?>" aria-current="page" href="rmdashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (comparePage() == 'manage_roomtypes.php') ? 'active' : ''; ?>" href="manage_roomtypes.php">Room Types / Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (comparePage() == 'manage_rooms.php') ? 'active' : ''; ?>" href="manage_rooms.php">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (comparePage() == 'admin_manage_accounts.php') ? 'active' : ''; ?>" href="admin_manage_accounts.php">User Accounts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>