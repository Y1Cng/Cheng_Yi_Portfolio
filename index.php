<?php
// Include PDO connection
require_once("includes/connect.php");

try {
    // Get ONLY active projects (exclude soft deleted)
    $sql = "SELECT * FROM project WHERE is_deleted = 0 ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    $projects = $stmt->fetchAll(); // Get all active projects as array
} catch (PDOException $e) {
    die("Failed to fetch projects: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Yi Cheng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/ScrollTrigger.min.js"></script>
</head>
<body style="background-color: #F8F8F8; color: #6E7B8B;">
    <!-- Header (保留原有代码，新增Admin链接) -->
    <header class="flex items-center justify-between px-4 md:px-16 py-4 md:py-8">
        <div class="flex items-center gap-2 md:gap-4">
            <div class="relative">
                <img src="./images/profile-image.svg" alt="Profile" class="w-10 h-10 md:w-12 md:h-12 rounded-full">
            </div>
            <div class="relative">
                <div class="hire-me-btn rounded-full px-4 py-2">
                    <span class="hire-me-text text-xs font-medium">Hire Me!</span>
                </div>
                <div class="absolute inset-0 border-2 border-dashed border-gray-400 rounded-full scale-110 pointer-events-none">
                </div>
                <img src="./images/arrow-icon.png" alt="Arrow" class="absolute -right-8 top-0 w-10 h-5 pointer-events-none">
            </div>
        </div>
        <button id="mobileMenuBtn"
            class="md:hidden flex flex-col justify-between w-6 h-5 bg-transparent border-none cursor-pointer"
            aria-label="Menu">
            <span class="block w-full h-0.5 bg-gray-500 transition-all duration-300"></span>
            <span class="block w-full h-0.5 bg-gray-500 transition-all duration-300"></span>
            <span class="block w-full h-0.5 bg-gray-500 transition-all duration-300"></span>
        </button>
        <nav class="main-nav hidden md:flex items-center gap-8 lg:gap-16">
            <a href="about.php" class="nav-link text-xl lg:text-2xl transition-colors">About Me</a>
            <a href="contact.php" class="nav-link text-xl lg:text-2xl transition-colors">Contact</a>
            <a href="index.php" class="nav-link active text-xl lg:text-2xl transition-colors">Portfolio</a>
            <a href="admin_login.php" class="nav-link text-xl lg:text-2xl transition-colors">Admin</a>
        </nav>
        <nav id="mobileMenu" class="overlay">
            <button id="closeMobileMenu" class="absolute top-4 right-4 text-3xl" style="color: #6E7B8B; background: none; border: none; cursor: pointer; font-size: 2rem;">&times;</button>
            <div class="flex flex-col items-center justify-center h-full gap-8">
                <a href="about.php" class="nav-link text-2xl transition-colors" style="color: #6E7B8B;">About Me</a>
                <a href="contact.php" class="nav-link text-2xl transition-colors" style="color: #6E7B8B;">Contact</a>
                <a href="index.php" class="nav-link text-2xl transition-colors" style="color: #6E7B8B;">Portfolio</a>
                <a href="admin_login.php" class="nav-link text-2xl transition-colors" style="color: #6E7B8B;">Admin</a>
            </div>
        </nav>
    </header>

    <main>
        <!-- Portfolio Filter -->
        <section class="px-4 md:px-16 py-8 md:py-16">
            <div class="max-w-6xl mx-auto">
                <h1 class="text-3xl md:text-4xl mb-8" style="font-family: 'Poppins', sans-serif; font-weight: 600; color: #0D0D0D;">My Portfolio</h1>
                
                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-4 mb-12">
                    <button class="filter-btn active px-4 py-2 rounded-full text-sm" data-filter="all" style="background-color: #FF6F61; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#FF8A7A'" onmouseout="this.style.backgroundColor='#FF6F61'">All</button>
                    <button class="filter-btn px-4 py-2 rounded-full text-sm" data-filter="UI & UX" style="background-color: #FF6F61; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#FF8A7A'" onmouseout="this.style.backgroundColor='#FF6F61'">UI & UX</button>
                    <button class="filter-btn px-4 py-2 rounded-full text-sm" data-filter="Motion Graphics" style="background-color: #FF6F61; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#FF8A7A'" onmouseout="this.style.backgroundColor='#FF6F61'">Motion Graphics</button>
                    <button class="filter-btn px-4 py-2 rounded-full text-sm" data-filter="Rebrand" style="background-color: #FF6F61; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#FF8A7A'" onmouseout="this.style.backgroundColor='#FF6F61'">Rebrand</button>
                    <button class="filter-btn px-4 py-2 rounded-full text-sm" data-filter="Backend" style="background-color: #FF6F61; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#FF8A7A'" onmouseout="this.style.backgroundColor='#FF6F61'">Backend</button>
                </div>

                <!-- Portfolio Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($projects as $project): ?>
                        <div class="portfolio-item" data-category="<?php echo htmlspecialchars($project['flag']); ?>">
                            <div class="rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                                <!-- Replace with actual project image -->
                                <img src="./images/project-<?php echo $project['id']; ?>.jpg" alt="<?php echo htmlspecialchars($project['project']); ?>" class="w-full h-64 object-cover">
                                <div class="p-6">
                                    <h3 class="text-xl mb-2" style="font-family: 'Poppins', sans-serif; color: #0D0D0D;"><?php echo htmlspecialchars($project['project']); ?></h3>
                                    <p class="text-sm mb-4" style="color: #6E7B8B;"><?php echo htmlspecialchars($project['flag']); ?></p>
                                    <a href="detail.php?id=<?php echo $project['id']; ?>" class="inline-block px-4 py-2 rounded-full text-sm" style="background-color: #FF6F61; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#FF8A7A'" onmouseout="this.style.backgroundColor='#FF6F61'">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="px-4 md:px-16 py-8 md:py-16 text-center">
        <p class="font-secondary text-xs" style="color: #6E7B8B;">@Yi Cheng. All rights reserved.</p>
    </footer>

    <script src="js/main.js" type="module"></script>
</body>
</html>