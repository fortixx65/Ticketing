<div id="layoutDrawer_nav">
    <!-- Drawer navigation-->
    <nav class="drawer accordion drawer-light bg-white" id="drawerAccordion">
        <div class="drawer-menu">
            <div class="nav">
                <!-- Divider-->
                <div class="drawer-menu-divider d-sm-none"></div>
                
                <!-- Drawer section heading (Interface)-->
                <div class="drawer-menu-heading">Tableau de bord</div>
                    <!-- Drawer link (Overview)-->
                    <a class="nav-link" href="{{ route("admin.index")}}">
                        <div class="nav-link-icon"><i class="material-icons">language</i></div>
                        Overview
                    </a>
                    <a class="nav-link" href="">
                        <div class="nav-link-icon"><i class="material-icons">language</i></div>
                        Tableau de bord
                    </a>
                
                <!-- Divider-->
                <div class="drawer-menu-divider"></div>
                <!-- Drawer section heading (Plugins)-->
                <div class="drawer-menu-heading">Utilisateurs</div>
                <!-- Drawer link (Charts)-->
                <a class="nav-link" href="{{ route("admin.users.index")}}">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Utilisateurs
                </a>
                <!-- Drawer link (Code Blocks)-->
                <a class="nav-link" href="{{ route("admin.roles.index")}}">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Grades
                </a>
                <a class="nav-link" href="">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Permissions
                </a>

                <!-- Divider-->
                <div class="drawer-menu-divider"></div>
                <!-- Drawer section heading (Plugins)-->
                <div class="drawer-menu-heading">Ticketing</div>
                <!-- Drawer link (Charts)-->
                <a class="nav-link" href="{{ route("admin.projects.index")}}">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Projects
                </a>
                <!-- Drawer link (Code Blocks)-->
                <a class="nav-link" href="{{ route("admin.tickets.index")}}">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Tickets
                </a>

                {{-- <!-- Divider-->
                <div class="drawer-menu-divider"></div>
                <!-- Drawer section heading (Plugins)-->
                <div class="drawer-menu-heading">Gestion</div>
                <!-- Drawer link (Charts)-->
                <a class="nav-link" href="{{ route("admin.types.index")}}">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Types
                </a>
                <!-- Drawer link (Code Blocks)-->
                <a class="nav-link" href="{{ route("admin.roles.index")}}">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Roles
                </a>

                <!-- Divider-->
                <div class="drawer-menu-divider"></div>
                <!-- Drawer section heading (Plugins)-->
                <div class="drawer-menu-heading">Permissions</div>
                <!-- Drawer link (Charts)-->
                <a class="nav-link" href="{{ route("admin.permissionsG.permissions")}}">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Permissions de l'outils
                </a>
                <!-- Drawer link (Code Blocks)-->
                <a class="nav-link" href="">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Permissions des projets
                </a>
                <!-- Drawer link (Code Blocks)-->
                <a class="nav-link" href="">
                    <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                    Permissions des roles
                </a> --}}
            </div>
        </div>
        <!-- Drawer footer        -->
        <div class="drawer-footer border-top">
            <div class="d-flex align-items-center">
                <i class="material-icons text-muted">account_circle</i>
                <div class="ms-3">
                    <div class="caption">Logged in as:</div>
                    <div class="small fw-500">Start Bootstrap</div>
                </div>
            </div>
        </div>
    </nav>
</div>