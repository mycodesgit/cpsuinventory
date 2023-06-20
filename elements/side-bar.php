<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar nav-compact flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Main Navigation</li>

        <li class="nav-item">
            <a href="./dashboard" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'dashboard' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-grip-horizontal"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="./inventory" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'inventory' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Inventory</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="./returned" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'returned' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Unserviceable</p>
            </a>
        </li>

        <li class="nav-header">Configuration</li>
        <!-- <li class="nav-item">
            <a href="./category" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'category' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>Category</p>
            </a>
        </li> -->
        
        <li class="nav-item">
            <a href="./classification" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'classification' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Classification</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="./offices" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'offices' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-building"></i>
                <p>Offices</p>
            </a>
        </li>

        <?php if($_SESSION['usertype'] == 'Administrator') {?>
        <li class="nav-header">Users Management</li>
        <li class="nav-item">
            <a href="./users" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'users' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="./logs" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'logs' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>Logs</p>
            </a>
        </li>
        <?php }?>
    </ul>
</nav>