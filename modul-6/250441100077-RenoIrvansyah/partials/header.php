<?php
if (isset($_GET["logout"])) {
    session_destroy();
    $script = "<script> window.location = 'auth/login.php' ;</script>";
    echo $script;
}
?>

<nav class="m-auto sticky top-0 z-50 bg-gray-200 w-full h-16 flex items-center justify-between px-4">
    <div class="text-xl font-bold">
        <a href="#">
            <img src="./assets/img/ticket-bgremove.png" alt="Logo" class="h-15 inline-block">
            CTicket</a>
    </div>
    <div>
        <ul class="flex space-x-4 gap-20">
            <li><a href="index.php" class="text-gray-700 hover:text-gray-900">Home</a></li>
            <li><a href="konser.php" class="text-gray-700 hover:text-gray-900">List Concert</a></li>
        </ul>
    </div>
    <div>
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="inline-flex items-center justify-center box-border border border-transparent hover:bg-neutral-strong focus:ring-1 focus:ring-neutral-medium shadow-2xl font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none" type="button">
            <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Username'; ?>    
            <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
            </svg>
        </button>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <div id="dropdown" class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="backend/dashboard.php" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Dashboard</a>
                    </li>
                    <li>
                        <a href="?logout" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Sign out</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
            <div id="dropdown" class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="?logout" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Sign out</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>

    </div>
</nav>