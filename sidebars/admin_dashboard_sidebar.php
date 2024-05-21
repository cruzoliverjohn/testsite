<link rel="stylesheet" href="CSS/admin_sidebar.css">
<aside id="sidebar">
    <header class="sidebar-header">
        <div class="d-flex">
            <button id="toggle-btn" type="button">
                <img src="IMG/menu.png" alt="Menu">
            </button>
        </div>
    </header>

    <!-- SIDEBAR -->
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="admin_dashboard.php" class="sidebar-link active"> <!-- ACTIVE -->
                <i class="fa-solid fa-chart-simple"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_manage_users.php" class="sidebar-link">
                <i class="fa-solid fa-user"></i>
                <span>Accounts Management</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_view_students.php" class="sidebar-link"> 
                <i class="fa-solid fa-user-graduate"></i>
                <span>Student Records</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_view_faculty.php" class="sidebar-link">
                <i class="fa-solid fa-user-tie"></i>
                <span>Faculty Records</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_manage_violation.php" class="sidebar-link">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Violation Management</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_manage_sanction.php" class="sidebar-link">
                <i class="fa-solid fa-gavel"></i>
                <span>Sanction Management</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_import.php" class="sidebar-link">
                <i class="fa-solid fa-file-import"></i>
                <span>Import</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_export.php" class="sidebar-link">
                <i class="fa-solid fa-file-export"></i>
                <span>Archive</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_academic_year.php" class="sidebar-link">
                <i class="fa-solid fa-calendar-week"></i>
                <span>Academic Year</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <span>Logged in as Admin</span>
    </div>
</aside>

<!-- HEADER -->
<section id="header-content">
    <header>
        <nav>
            <span class="divider"></span>
            <div class="profile">
                <ul class="profile-link">
                    <li><a href="includes/admin_logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                </ul>
                <?php 
                if (isset($_SESSION['user_name'])): ?>
                    <span style="color: black; font-weight: bold; margin-right: 20px;"><?php echo $_SESSION['user_name']; ?></span>
                <?php endif; ?>

                <img src="IMG/profile.png" alt="">
            </div>
        </nav>
    </header>
</section>