<header class="h-15 bg-white shadow-xl flex justify-between items-center px-8">
    <div class=""></div>
    <div class=""></div>
    <div class="flex items-center gap-3">
        <div class="flex">
            <h3>Admin : <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Username'; ?></h3>
        </div>
    </div>
</header>