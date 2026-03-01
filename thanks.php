<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks | Yi Cheng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="bg-white text-gray-600">
    <header class="flex items-center justify-between px-4 md:px-16 py-4 md:py-8">
        <div class="flex items-center gap-2 md:gap-4">
            <div class="relative">
                <a href="index.php">
                    <img src="./images/profile-image.png" alt="Profile" class="w-10 h-10 md:w-12 md:h-12 rounded-full">
                </a>
            </div>
            <div class="relative">
                <div class="hire-me-btn rounded-full px-4 py-2">
                    <span class="hire-me-text text-xs font-medium">Hire Me!</span>
                </div>
                <div class="absolute inset-0 border-2 border-dashed border-gray-400 rounded-full scale-110 pointer-events-none"></div>
                <img src="./images/arrow-icon.png" alt="Arrow" class="absolute -right-8 top-0 w-10 h-5 pointer-events-none">
            </div>
        </div>
        <nav class="main-nav hidden md:flex items-center gap-8 lg:gap-16">
            <a href="about.php" class="nav-link text-xl lg:text-2xl transition-colors">About Me</a>
            <a href="contact.php" class="nav-link text-xl lg:text-2xl transition-colors">Contact</a>
            <a href="index.php" class="nav-link text-xl lg:text-2xl transition-colors">Portfolio</a>
        </nav>
    </header>

    <main>
    <section class="px-4 md:px-16 py-12 md:py-20">
        <div class="max-w-xl mx-auto text-center bg-gray-50 border border-gray-200 rounded-2xl p-10 shadow-sm">
            <div class="flex justify-center mb-6">
                <img src="./images/thinks.png" alt="Success" class="w-20 h-20 object-contain">
            </div>
            <h1 class="text-3xl md:text-4xl text-gray-500 mb-4">Thanks for submitting!</h1>
            <p class="font-secondary text-gray-500 text-sm md:text-base mb-6">Your message has been sent! I'll get back to you shortly.</p>
            <div class="flex justify-center gap-4">
                <a href="index.php" class="bg-gray-500 text-white px-6 py-2 rounded-full text-sm hover:bg-gray-600 transition-colors">Back to Home</a>
                <a href="contact.php" class="border border-gray-300 text-gray-500 px-6 py-2 rounded-full text-sm hover:bg-gray-100 transition-colors">Send Another</a>
            </div>
        </div>
    </section>
    </main>

    <footer class="px-4 md:px-16 py-8 md:py-16 text-center">
        <p class="font-secondary text-gray-500 text-xs">@Yi Cheng. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>

