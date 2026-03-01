<?php
require_once('includes/connect.php');

$query = "SELECT * FROM project LIMIT 4";
$results = $pdo->query($query);

$imageMap = array(
    'flowsonic' => 'flowsonic_earbuds_x-ray_1_0000.jpg',
    'sports' => 'stadium_1_1582.jpg',
    'quatro' => 'quatro-project-outdoor.jpg',
    'contact' => 'backend project image.png',
    'portfolio contact' => 'backend project image.png'
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me | Yi Cheng</title>
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

<body>
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

        <!-- Mobile Menu Button -->
        <button id="mobileMenuBtn"
            class="md:hidden flex flex-col justify-between w-6 h-5 bg-transparent border-none cursor-pointer"
            aria-label="Menu">
            <span class="block w-full h-0.5 bg-gray-500 transition-all duration-300"></span>
            <span class="block w-full h-0.5 bg-gray-500 transition-all duration-300"></span>
            <span class="block w-full h-0.5 bg-gray-500 transition-all duration-300"></span>
        </button>

        <!-- Navigation -->
        <nav class="main-nav hidden md:flex items-center gap-8 lg:gap-16">
            <a href="about.php" class="nav-link active text-xl lg:text-2xl transition-colors">About Me</a>
            <a href="contact.php" class="nav-link text-xl lg:text-2xl transition-colors">Contact</a>
            <a href="index.php" class="nav-link text-xl lg:text-2xl transition-colors">Portfolio</a>
        </nav>

        <!-- Mobile Navigation Menu -->
        <nav id="mobileMenu" class="overlay">
            <button id="closeMobileMenu" class="absolute top-4 right-4 text-3xl" style="color: #6E7B8B; background: none; border: none; cursor: pointer; font-size: 2rem;">&times;</button>
            <div class="flex flex-col items-center justify-center h-full gap-8">
                <a href="about.php" class="nav-link text-2xl transition-colors" style="color: #6E7B8B;">About Me</a>
                <a href="contact.php" class="nav-link text-2xl transition-colors" style="color: #6E7B8B;">Contact</a>
                <a href="index.php" class="nav-link text-2xl transition-colors" style="color: #6E7B8B;">Portfolio</a>
            </div>
        </nav>

    </header>

    <main class="main-content">
        <!-- About Info Section -->
        <section class="about-info-section px-4 md:px-16 py-8 md:py-16">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl md:text-4xl mb-8"
                    style="font-family: 'Poppins', sans-serif; font-weight: 600; color: #0D0D0D;">About Me</h1>
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div class="bg-gray-300 h-64 md:h-80 rounded-lg">
                        <img src="./images/profile-image.png" alt="Yi Cheng Profile"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="max-w-xs">
                        <p class="font-secondary text-sm leading-relaxed mb-4" style="color: #6E7B8B;">
                            I'm Yi, a web developer, UI/UX designer, and motion graphics creator - I bring digital
                            projects
                            to life from code to animation.
                        </p>
                        <p class="font-secondary text-sm leading-relaxed mb-4" style="color: #6E7B8B;">
                            Work ethic? Simple: I don't stop until it's right.
                        </p>
                        <p class="font-secondary text-sm leading-relaxed mb-4" style="color: #6E7B8B;">
                            Tight deadline? All-nighter? Challenge accepted.
                        </p>
                        <p class="font-secondary text-sm leading-relaxed" style="color: #6E7B8B;">
                            Let's collaborate—hit me up for projects that need sharp design and relentless execution.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Demo Reel Video Section -->
        <section class="demo-reel-section px-2 md:px-8 py-4 md:py-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl mb-8"
                    style="font-family: 'Poppins', sans-serif; font-weight: 600; color: #0D0D0D;">Demo Reel</h2>
                <div class="bg-gray-300 rounded-lg overflow-hidden">
                    <video controls class="w-full h-auto" poster="./images/video-poster.jpg">
                        <source src="./videos/Cheng_Yi_Demo_Reel.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </section>
                <section class="projects-section">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php
                    while($row = $results->fetch()) {
                        $projectName = strtolower($row['project']);
                        $projectImage = './images/image-placeholder.png';
                        
                        foreach($imageMap as $key => $image) {
                            if(strpos($projectName, $key) !== false) {
                                $encodedImage = str_replace(' ', '%20', $image);
                                $projectImage = './images/'.$encodedImage;
                                break;
                            }
                        }
                        
                        echo '<a href="detail.php?id='.$row['id'].'" class="bg-gray-300 h-32 md:h-48 rounded-lg overflow-hidden relative group">
                            <img src="'.$projectImage.'" alt="'.htmlspecialchars($row['project'], ENT_QUOTES, 'UTF-8').'"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" onerror="this.src=\'./images/image-placeholder.png\'">
                        </a>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="site-footer px-4 md:px-16 py-8 md:py-16 text-center">
        <p class="font-secondary text-xs" style="color: #6E7B8B;">@Yi Cheng. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>

</html>