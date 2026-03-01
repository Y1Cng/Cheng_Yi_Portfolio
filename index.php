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
<body>
    <!-- Header -->
    <header class="site-header flex items-center justify-between px-4 md:px-16 py-4 md:py-8">
        <div class="flex items-center gap-2 md:gap-4">
            <div class="relative">
                <a href="index.php">
                    <img src="./images/profile-image.svg" alt="Profile" class="w-10 h-10 md:w-12 md:h-12 rounded-full">
                </a>
            </div>
            <div class="relative">
                <a href="contact.php">
                    <div class="hire-me-btn rounded-full px-4 py-2">
                        <span class="hire-me-text text-xs font-medium">Hire Me!</span>
                    </div>
                </a>
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
        </nav>
        <nav id="mobileMenu" class="overlay">
            <button id="closeMobileMenu" class="absolute top-4 right-4 text-3xl">&times;</button>
            <div class="flex flex-col items-center justify-center h-full gap-8">
                <a href="about.php" class="nav-link text-2xl transition-colors">About Me</a>
                <a href="contact.php" class="nav-link text-2xl transition-colors">Contact</a>
                <a href="index.php" class="nav-link text-2xl transition-colors">Portfolio</a>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <!-- Portfolio Filter -->
        <section class="portfolio-section px-4 md:px-16 py-8 md:py-16">
            <div class="max-w-6xl mx-auto">
                <h1 class="text-3xl md:text-4xl mb-8">My Portfolio</h1>
                
                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-4 mb-12">
                    <button class="filter-btn active px-4 py-2 rounded-full text-sm shadow-lg hover:shadow-xl transition-shadow" data-filter="all">All</button>
                    <button class="filter-btn px-4 py-2 rounded-full text-sm shadow-lg hover:shadow-xl transition-shadow" data-filter="ui">UI & UX</button>
                    <button class="filter-btn px-4 py-2 rounded-full text-sm shadow-lg hover:shadow-xl transition-shadow" data-filter="motion">Motion Graphics</button>
                    <button class="filter-btn px-4 py-2 rounded-full text-sm shadow-lg hover:shadow-xl transition-shadow" data-filter="rebrand">Rebrand</button>
                    <button class="filter-btn px-4 py-2 rounded-full text-sm shadow-lg hover:shadow-xl transition-shadow" data-filter="backend">Backend</button>
                </div>

                <!-- Portfolio Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($projects as $project): ?>
                        <div class="portfolio-item min-h-[400px]" data-category="<?php echo strtolower($project['flag']); ?>">
                            <div class="rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow flex flex-col h-full">
                                <!-- Project image -->
                                <img src="./images/<?php echo $project['image'] ?? 'image-placeholder.png'; ?>" alt="<?php echo htmlspecialchars($project['project']); ?>" class="w-full h-64 object-cover">
                                <div class="p-6 flex flex-col justify-between flex-grow">
                                    <h3 class="text-xl mb-2"><?php echo htmlspecialchars($project['project']); ?></h3>
                                    <p class="text-sm mb-4"><?php echo htmlspecialchars($project['flag']); ?></p>
                                    <a href="detail.php?id=<?php echo $project['id']; ?>" class="inline-self-start bg-[#aeec7a] text-gray-800 px-4 py-1 rounded-lg text-sm transition-colors w-fit">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="site-footer px-4 md:px-16 py-8 md:py-16 text-center">
        <p class="font-secondary text-xs" style="color: #6E7B8B;">@Yi Cheng. All rights reserved.</p>
    </footer>

    <script src="js/main.js" type="module"></script>
</body>
</html>