<?php require("urlcheck.php"); ?>


<div class="container-fluid bg-dark text-light p-4 d-flex align-items-center justify-content-between sticky-top">
    <h1 class="m-0">Reservations Manager</h1>
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
                            <a class="nav-link <?php echo (comparePage() == 'rmdashboard.php') ? 'active' : ''; ?>" aria-current="page" href="rmdashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (comparePage() == 'managebookings.php') ? 'active' : ''; ?>" aria-current="page" href="managebookings.php">Manage Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (comparePage() == 'managebillings.php') ? 'active' : ''; ?>" aria-current="page" href="managebillings.php">Manage Billings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (comparePage() == 'checkout.php') ? 'active' : ''; ?>" aria-current="page" href="checkout.php">Checked Out Records</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (comparePage() == 'cancelledrec.php') ? 'active' : ''; ?>" aria-current="page" href="cancelledrec.php">Cancelled Records</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>