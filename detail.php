<?php
require_once('includes/connect.php');

$selected_project = $_GET['id'];

$query = "SELECT * FROM project WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $selected_project]);
$row = $stmt->fetch();

// Get random projects excluding current one
$randomQuery = "SELECT * FROM project WHERE id != :current_id AND is_deleted = 0 ORDER BY RAND() LIMIT 4";
$randomStmt = $pdo->prepare($randomQuery);
$randomStmt->execute([':current_id' => $selected_project]);
$randomProjects = $randomStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Detail | Yi Cheng</title>
    <link rel="icon" type="image/png" href="./images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="./images/favicon.svg" />
    <link rel="shortcut icon" href="./images/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="./images/apple-touch-icon.png" />
    <link rel="manifest" href="./images/site.webmanifest" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/ScrollTrigger.min.js"></script>
</head>

<body class="bg-white text-gray-600">
    <!-- Header -->
    <header class="site-header flex items-center justify-between px-4 md:px-16 py-4 md:py-8">
        <!-- Logo Section -->
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

        <!-- Navigation -->
        <nav class="main-nav hidden md:flex items-center gap-8 lg:gap-16">
            <a href="about.php" class="nav-link text-xl lg:text-2xl transition-colors">About Me</a>
            <a href="contact.php" class="nav-link text-xl lg:text-2xl transition-colors">Contact</a>
            <a href="index.php" class="nav-link active text-xl lg:text-2xl transition-colors">Portfolio</a>
        </nav>
    </header>

    <main class="main-content">
    <!-- Project Info Section -->
    <section class="project-info-section px-4 md:px-16 py-8 md:py-16">
        <div class="max-w-5xl mx-auto">
            <?php
            $imageSrc = $row['image'] ?? 'image-placeholder.png';
            $url = $row['url'] ?? '#';
            $description = $row['description'] ?? 'No description available.';
            $tools = $row['tools'] ?? 'Not specified';
            $techniques = $row['techniques'] ?? 'Not specified';
            echo '<h1 class="text-3xl md:text-4xl text-gray-500 mb-8">'.$row['project'].'</h1>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <div class="mb-6">
                        <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-2"><strong>Tools Used:</strong> '.$tools.'</p>
                        <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-2"><strong>Techniques:</strong> '.$techniques.'</p>
                    </div>
                    <div class="mb-6">
                        <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-2">'.$description.'</p>
                        <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-2">'.$row['flag'].'</p>
                    </div>
                    <a href="'.$url.'" target="_blank"><button class="bg-[#aeec7a] text-gray-800 px-4 py-1 rounded-lg text-sm hover:bg-[#96d165] transition-colors w-fit">Visit URL</button></a>
                </div>
                <div class="bg-gray-300 h-64 md:h-96 rounded-lg">
                    <img src="./images/'.$imageSrc.'" alt="'.htmlspecialchars($row['project']).'" class="w-full h-full object-cover rounded-lg" onerror="this.src=\'./images/image-placeholder.png\'">
                </div>
            </div>';
            ?>
        </div>
    </section>

    <!-- Featured Works Section -->
    <section class="featured-works-section px-4 md:px-16 py-8 md:py-16">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl md:text-3xl text-gray-500 mb-8 text-center">Don't miss these selected pieces from my portfolio</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php foreach ($randomProjects as $project): ?>
                    <a href="detail.php?id=<?php echo $project['id']; ?>" class="bg-gray-300 h-32 md:h-48 rounded-lg overflow-hidden relative group">
                        <img src="./images/<?php echo $project['image'] ?? 'image-placeholder.png'; ?>" alt="<?php echo htmlspecialchars($project['project']); ?>"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" onerror="this.src='./images/image-placeholder.png'">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    </main>

    <!-- Footer -->
    <footer class="site-footer px-4 md:px-16 py-8 md:py-16 text-center">
        <button class="back-to-top bg-gray-300 rounded-full p-3 md:p-4 mb-6 md:mb-8 hover:bg-gray-400 transition-colors">
            <img src="./images/up-arrow-btn.png" alt="Back to top" class="w-5 h-5 md:w-6 md:h-6">
        </button>
        <p class="font-secondary text-gray-500 text-xs">@Yi Cheng. All rights reserved.</p>
    </footer>

    <script src="js/main.js" type="module"></script>
</body>

</html>

