<?php session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../landingpage.php');
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- My CSS -->
    <link rel="stylesheet" href="../../css/AuthLayout/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/ez.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">
    <title>DPS</title>
</head>
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-info" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Loading. Please wait...</p>
    </div>
</div>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                class='bx bxs-shield'></i>DPS</div>
        <div class="list-group list-group-flush my-3">
            <ul class="side-menu">
                <li class="tab is-active">
                    <a href="?page=dashboard" data-switcher data-tab="dashboard"
                        class="tab is-active list-group-item list-group-item-action bg-transparent text-success-emphasis"><i
                            class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                </li>

                <li class="tab">
                    <a href="?page=users" data-switcher data-tab="users"
                        class="list-group-item list-group-item-action bg-transparent text-success-emphasis"><i
                            class='bx bxs-user'></i> Users</a>
                </li>
                <li class="tab">
                    <a href="?page=user-list" data-switcher data-tab="user-list"
                        class="list-group-item list-group-item-action bg-transparent text-success-emphasis"><i
                            class='bx bxs-user'></i> User List</a>
                </li>

                <li class="tab">
                    <a href="?page=applicants" data-switcher data-tab="applicants"
                        class="list-group-item list-group-item-action bg-transparent text-success-emphasis"><i
                            class='bx bxs-file-blank'></i> Applicants <span id="pendingCount"
                            class="badge text-bg-danger"></span>
                    </a>
                </li>

                <button onclick="logOut()"
                    class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</button>
            </ul>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-2 m-0"><?php $_GET['page'] ?></h2>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i>John Doe
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="tab is-active"><a class="dropdown-item" href="#">Profile</a></li>
                            <li class="tab"><a class="dropdown-item" href="#">Settings</a></li>
                            <li class="tab"><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <section class="pages">
            <div class="card shadow custom-card">

                <div class="page is-active" data-page="dashboard">

                </div>

                <div class="page" data-page="users">

                </div>

                <div class="page" data-page="user-list">

                </div>

                <div class="page" data-page="applicants">

                </div>

                <div class="page" data-page="viewApplicant">

                </div>
            </div>
        </section>

    </div>
</div>
<!-- /#page-content-wrapper -->
</div>
<!-- CONTENT -->

<script src="../../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };

    function logOut() {
        Swal.fire({
            title: "Are you sure you want to log out?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('loadingOverlay').style.display = 'block';
                window.location.href = "../../controller/authentication/logout_action.php";
            }
        });
    }
</script>
<script>
    var currentYear = new Date().getFullYear();
    document.addEventListener("DOMContentLoaded", () => {
        const tabSwitchers = document.querySelectorAll('[data-switcher]');
        const urlParams = new URLSearchParams(window.location.search);
        const initialPage = urlParams.get('page') || 'dashboard';

        // Set up click event listeners for tab switchers
        tabSwitchers.forEach(tabSwitcher => {
            tabSwitcher.addEventListener('click', (event) => {
                event.preventDefault();
                const pageId = tabSwitcher.dataset.tab;

                document.querySelector('.side-menu .tab.is-active').classList.remove('is-active');
                tabSwitcher.parentNode.classList.add('is-active');

                loadPageContent(pageId);

                // Update URL without reloading the page
                history.pushState({ page: pageId }, '', `${window.location.pathname}?page=${pageId}`);
            });
        });

        // Load content for the initial page if it exists
        loadPageContent(initialPage);

        // Fetch and display content for a given page
        function loadPageContent(pageId) {
            let pageUrl;

            // Map route names to file paths
            switch (pageId) {
                case 'dashboard':
                    pageUrl = 'dashboard.php';
                    break;
                case 'users':
                    pageUrl = 'users/index.php';
                    break;
                case 'user-list':
                    pageUrl = 'users/user-list.php';
                break;
                case 'applicants':
                    pageUrl = 'applicants/index.php';
                    break;
                case 'viewApplicant':
                    pageUrl = 'applicants/view.php';
                    break;
                default:
                    console.error(`No page found for route: ${pageId}`);
                    return;
            }

            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'block';

            fetch(pageUrl)
                .then(response => {
                    if (!response.ok) throw new Error(`Network response was not ok ${response.statusText}`);
                    return response.text();
                })
                .then(html => {
                    const page = document.querySelector(`.pages .page[data-page="${pageId}"]`);
                    page.innerHTML = html;

                    // Switch to the loaded page and hide the loading overlay
                    switchPage(pageId);

                    // Call getApplicants if the applicants page is loaded
                    if (pageId === 'applicants') {
                        getApplicants();
                    } else if (pageId === 'viewApplicant') {
                        getApplicantDetails();
                    } else if(pageId === 'dashboard') {
                        getLineGraphData();
                        getApplicantCountByStatus();
                    }
                })
                .catch(error => {
                    console.log(`Error loading page: ${error}`);
                    document.getElementById('loadingOverlay').style.display = 'none';
                });

            InitDatatable();
            getApplicantsPendingCount();
        }

        // Function to switch to the specified page
        function switchPage(pageId) {
            const pages = document.querySelectorAll('.pages .page');
            pages.forEach(page => {
                if (page.dataset.page === pageId) {
                    page.classList.add('is-active');
                } else {
                    page.classList.remove('is-active');
                    page.innerHTML = '';  // Clear other pages to free memory
                }
            });
            $('#myTable').DataTable();
            document.getElementById('loadingOverlay').style.display = 'none';
        }
    });

    function InitDatatable() {
        $('#myTable').DataTable();
    } 
</script>
<script src="../../view/js/applicants/index.js?v=<?php echo time(); ?>"></script>
<script src="../../view/js/applicants/view.js?v=<?php echo time(); ?>"></script>
<!-- <script src="../../view/js/AuthLayout/script.js?v=<?php echo time(); ?>"></script> -->
<script src="../../view/js/user/index.js?v=<?php echo time(); ?>"></script>
<script src="../../view/js/user/add_user.js?v=<?php echo time(); ?>"></script>


<script src="../../view/js/dashboard/dashboard.js?v=<?php echo time(); ?>"></script>
</body>

</html>