<nav class="container mx-auto px-6 py-4">
    <div class="flex justify-between items-center">
        <div class="text-2xl font-bold">NutriTrack<span class="text-secondary">2025</span></div>
        <div class="space-x-4 hidden md:flex items-center">
            <a href="../index.php" class="hover:text-secondary transition color-white">Home</a>
            <?php if (isset($_SESSION['firstname'])): ?>
                <a href="../dashboard/user.php" class="hover:text-secondary transition">Dashboard</a>
                <a href="../settings/user.php" class="hover:text-secondary transition">Profile</a>
                <?php if ($_SESSION['admin'] == 1): ?>
                    <a href="../admin/dashboard.php" class="hover:text-secondary transition">Admin Panel</a>
                <?php endif; ?>
                <a href="../logout.php" class="bg-white text-primary px-4 py-2 rounded-lg shadow hover:bg-opacity-90 transition">Sign Out</a>
            <?php else: ?>
                <a href="../login.php" class="bg-white text-primary px-4 py-2 rounded-lg shadow hover:bg-opacity-90 transition">Login</a>
            <?php endif; ?>
        </div>
        <button class="md:hidden text-2xl"><i class="fas fa-bars"></i></button>
    </div>
</nav>
