<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Yi Cheng</title>
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
    <!-- Added: Style for form message display (can be merged into main.css) -->
    <style>
        .form-msg {
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1rem 0;
            font-size: 0.875rem;
        }
        .form-msg.hidden {
            display: none;
        }
        .form-msg.success {
            background-color: #A8E6CF;
            color: #0D0D0D;
        }
        .form-msg.error {
            background-color: #FFCCCB;
            color: #D8000C;
        }
    </style>
</head>

<body style="background-color: #F8F8F8; color: #6E7B8B;">
    <!-- Header (unchanged original code) -->
    <header class="site-header flex items-center justify-between px-4 md:px-16 py-4 md:py-8">
        <div class="flex items-center gap-2 md:gap-4">
            <div class="relative">
                <a href="index.php">
                    <img src="./images/profile-image.svg" alt="Profile" class="w-10 h-10 md:w-12 md:h-12 rounded-full">
                </a>
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
            <a href="contact.php" class="nav-link active text-xl lg:text-2xl transition-colors">Contact</a>
            <a href="index.php" class="nav-link text-xl lg:text-2xl transition-colors">Portfolio</a>
        </nav>
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
    <!-- Contact Form Section (only form part modified) -->
    <section class="contact-form-section px-4 md:px-16 py-8 md:py-16">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl md:text-4xl mb-8" style="font-family: 'Poppins', sans-serif; font-weight: 600; color: #0D0D0D;">Get In Touch</h1>
            <div class="mb-8">
                <p class="font-secondary text-sm mb-2" style="color: #6E7B8B;">Your message here → My reply here → Amazing project everywhere.</p>
                <p class="font-secondary text-sm" style="color: #6E7B8B;">Let's start a conversation that could lead to something awesome!</p>
                <!-- Removed: Legacy GET parameter message (replaced with AJAX message) -->
            </div>

            <!-- Core changes: 1. Removed action/method 2. Added form ID 3. Added message container -->
            <form id="contactForm" class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm mb-2 text-left" style="color: #6E7B8B;">Name*</label>
                        <input type="text" id="name" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none" style="border-color: #6E7B8B; color: #0D0D0D;" onfocus="this.style.borderColor='#FF6F61'" onblur="this.style.borderColor='#6E7B8B'">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm mb-2 text-left" style="color: #6E7B8B;">Phone Number*</label>
                        <input type="tel" id="phone" name="phone" required class="w-full px-4 py-2 border rounded-lg focus:outline-none" style="border-color: #6E7B8B; color: #0D0D0D;" onfocus="this.style.borderColor='#FF6F61'" onblur="this.style.borderColor='#6E7B8B'">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm mb-2 text-left" style="color: #6E7B8B;">Email*</label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none" style="border-color: #6E7B8B; color: #0D0D0D;" onfocus="this.style.borderColor='#FF6F61'" onblur="this.style.borderColor='#6E7B8B'">
                </div>
                <div>
                    <label for="message" class="block text-sm mb-2 text-left" style="color: #6E7B8B;">Message*</label>
                    <textarea id="message" name="message" rows="5" required class="w-full px-4 py-2 border rounded-lg focus:outline-none" style="border-color: #6E7B8B; color: #0D0D0D;" onfocus="this.style.borderColor='#FF6F61'" onblur="this.style.borderColor='#6E7B8B'"></textarea>
                </div>
                <!-- Added: AJAX message display container -->
                <div id="formMessage" class="form-msg hidden"></div>
                <button type="submit" name="submit" class="px-6 py-2 rounded-full text-sm transition-colors" style="background-color: #FF6F61; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#FF8A7A'" onmouseout="this.style.backgroundColor='#FF6F61'">Submit</button>
            </form>
        </div>
    </section>
    </main>

    <!-- Footer (unchanged) -->
    <footer class="site-footer px-4 md:px-16 py-8 md:py-16 text-center">
        <p class="font-secondary text-xs" style="color: #6E7B8B;">@Yi Cheng. All rights reserved.</p>
    </footer>

    <!-- Core change: 1. Added ES6 module type 2. Preserved original main.js logic -->
    <script src="js/main.js" type="module"></script>
</body>

</html>