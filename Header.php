<nav class="navbar navbar-expand navbar-dark bg-secondary sticky-top">
  <div class="container-lg">
    <a class="navbar-brand" href="."><i class="bi bi-moon"></i> ARUTALA</a>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

            <i class="bi bi-person-circle"></i>
            <?php
            if (isset($hasil['username'])) {
              echo $hasil['username'];
            }
            ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end mt-2">
            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person"></i> Profile</a></li>
            <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear"></i> Settings</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>