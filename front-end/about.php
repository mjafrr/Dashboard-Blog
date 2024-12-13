<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/css/style.css" />

    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="src/img/favicon.png" />
    <!-- local icons -->
    <link
        rel="stylesheet"
        id="icons"
        href="vendors/bootstrap-icons/font/bootstrap-icons.min.css" />

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@500;900&amp;display=swap"
        rel="stylesheet" />
</head>

<body>
    <header x-data="{ navtoggle: false }" class="flex flex-col">
        <!-- top -->
        <div class="border-b border-dashed border-neutral-200">
            <div
                class="container xl:max-w-6xl mx-auto px-4 flex items-center justify-between gap-3">
                <ul
                    class="max-sm:grow max-sm:overflow-hidden flex items-center text-sm">
                    <li class="relative">
                        <a href="index.php" class="py-1.5 px-3 hover:text-neutral-900">Home</a>
                    </li>
                    <li class="relative">
                        <a href="profile.php" class="py-1.5 px-3 hover:text-neutral-900">Profile</a>
                    </li>
                    <li class="relative">
                        <a href="docs.html" class="py-1.5 px-3 hover:text-neutral-900">Docs</a>
                    </li>
                </ul>

                <!-- social icon -->
                <div class="flex items-center">
                    <a href="#" class="p-2 hover:opacity-80">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="p-2 hover:opacity-80">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="p-2 hover:opacity-80">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="#" class="p-2 hover:opacity-80">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="p-2 hover:opacity-80">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
            </div>
        </div>

        <div x-data="{ searchtoggle: false }" class="flex flex-col">
            <!-- logo & Button-->
            <div class="mob-sticky max-md:z-20 max-md:bg-white">
                <div
                    class="container xl:max-w-6xl mx-auto px-4 flex items-center gap-3 justify-between md:justify-center">
                    <button
                        @click="navtoggle = !navtoggle"
                        class="size-10 text-2xl md:hidden">
                        <i
                            :class="{ 'block': navtoggle, 'hidden': !(navtoggle) }"
                            class="bi bi-x-lg"></i>
                        <i
                            :class="{ 'hidden': navtoggle, 'block': !(navtoggle) }"
                            class="bi bi-list"></i>
                    </button>

                    <a href="index.php" class="py-4 md:py-6 lg:py-12">
                        <h2 class="text-4xl md:text-5xl font-medium">ABOUT US</h2>
                        <!-- <img src="../src/img/logo.png">-->
                    </a>

                    <button
                        @click="searchtoggle = !searchtoggle"
                        class="size-10 text-xl md:hidden">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>


            <!-- menu -->
            <nav
                id="target-nav"
                :class="{ 'show': navtoggle, '': !(navtoggle) }"
                class="nav-sticky max-md:fixed max-md:w-72 max-md:inset-y-0 max-md:left-0 max-md:[&.show]:translate-x-0 bg-white md:border-y border-dashed border-neutral-200 z-50 max-md:-translate-x-full transition-transform duration-300">
                <div
                    class="md:hidden py-2 text-center text-neutral-500 text-xs uppercase border-b border-neutral-100 mb-1.5">
                    Menu
                </div>
                <!-- menu -->
                <ul
                    class="relative flex md:items-center md:justify-center max-md:flex-col max-md:h-full max-md:overflow-auto text-sm md:text-base uppercase">
                    <li class="relative">
                        <a
                            href="index.php"
                            class="py-2 px-4 flex max-md:justify-between gap-2 [&.active]:text-black [&.active]:bg-neutral-100 hover:text-black hover:bg-neutral-100">Homepage</a>
                    </li>
                    <li class="relative">
                        <a
                            href="author.php"
                            class="py-2 px-4 flex max-md:justify-between gap-2 [&.active]:text-black [&.active]:bg-neutral-100 hover:text-black hover:bg-neutral-100">Author</a>
                    </li>

                    <li class="relative">
                        <a
                            href="about.php"
                            class="py-2 px-4 flex max-md:justify-between gap-2 [&.active]:text-black [&.active]:bg-neutral-100 hover:text-black hover:bg-neutral-100">About</a>
                    </li>
                    <li class="relative">
                        <a
                            href="contact.php"
                            class="py-2 px-4 flex max-md:justify-between gap-2 [&.active]:text-black [&.active]:bg-neutral-100 hover:text-black hover:bg-neutral-100">Contact</a>
                    </li>

                    <li class="relative max-md:hidden">
                        <button
                            @click="searchtoggle = !searchtoggle"
                            class="py-2 px-4 flex max-md:justify-between gap-2 [&.active]:text-black [&.active]:bg-neutral-100 hover:text-black hover:bg-neutral-100">
                            <i class="bi bi-search"></i>
                        </button>
                    </li>
                </ul>
                <!-- credit -->
                <div
                    class="absolute bottom-0 inset-x-0 md:hidden py-2 text-center text-neutral-500 text-xs mb-2">
                    Copyright 2024
                </div>
            </nav>
            <!-- bg mobile sidebar -->
            <button
                @click="navtoggle = !navtoggle"
                :class="{ 'show': navtoggle, '': !(navtoggle) }"
                class="max-md:fixed max-md:bg-black max-md:[&.show]:inset-0 max-md:opacity-0 max-md:[&.show]:opacity-50 max-md:[&.show]:z-30 transform duration-300 lg:hidden"></button>

            <!-- modal search -->
            <div
                x-show="searchtoggle"
                class="z-[60] overflow-auto inset-0 w-full h-full fixed py-6">
                <div
                    @click.away="searchtoggle = false"
                    class="z-[60] relative p-3 mx-auto my-0 max-w-full sm:max-w-[500px] opacity-0 [&.show]:opacity-100"
                    :class="! searchtoggle ? '' : 'show'"
                    x-show="searchtoggle"
                    x-transition.duration.500ms>
                    <div
                        class="bg-white rounded border border-neutral-200 flex flex-col overflow-hidden">
                        <!-- modal content -->
                        <div class="p-6 flex flex-col">
                            <div class="flex justify-between gap-3 items-center mb-3">
                                <h3 class="text-lg">Search</h3>
                                <button
                                    @click="searchtoggle = false"
                                    class="fill-current text-2xl font-semibold">
                                    ×
                                </button>
                            </div>
                            <div
                                class="max-w-full w-full flex relative overflow-hidden mb-8">
                                <label for="search-form" class="hidden">Search</label>
                                <input
                                    type="text"
                                    class="w-full h-12 leading-5 relative py-3 px-5 text-neutral-800 bg-white border border-neutral-200 overflow-x-auto focus:outline-none focus:border-neutral-400 focus:ring-0 peer"
                                    id="search-form" />
                                <!-- icon -->
                                <button
                                    class="size-12 flex justify-center items-center absolute end-0 top-0 border border-neutral-200 bg-neutral-100 peer-focus:border-neutral-400">
                                    <span class="bi bi-search text-base leading-none"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bg modal -->
            </div>
    </header>
    <section class="min-h-screen bg-neutral-50 text-neutral-800">
        <div class="max-w-6xl mx-auto px-6 py-12">
            <!-- Header -->
            <header class="text-center mb-12">
                <p class="text-lg text-neutral-600">Learn more about BLOG ID, our vision, and the team behind the stories.</p>
            </header>

            <!-- Content -->
            <div class="flex items-center">
                <!-- Image -->
                <div class="w-full aspect-[4/3] overflow-hidden rounded-md bg-neutral-100 gap-8">
                    <img src="../front-end/src/img/blogs/7.jpg" alt="" class="w-full h-full object-cover rounded-lg">
                </div>
                <!-- Text Content -->
                <div class="p-4">
                    <h2 class="text-2xl font-semibold text-neutral-900 mb-4">Who We Are</h2>
                    <p class="text-neutral-600 leading-relaxed mb-6">
                        BLOG ID is a platform that brings stories, insights, and inspirations to life. From the latest trends to timeless topics, we aim to connect with our readers through meaningful content.
                    </p>
                    <h3 class="text-xl font-medium text-neutral-800 mb-3">Our Vision</h3>
                    <p class="text-neutral-600 leading-relaxed mb-6">
                        To create a space where knowledge and creativity come together, empowering individuals to explore, learn, and share their passions.
                    </p>
                    <h3 class="text-xl font-medium text-neutral-800 mb-3">Meet the Team</h3>
                    <p class="text-neutral-600 leading-relaxed">
                        Behind every story is a team of passionate writers, editors, and creators dedicated to delivering high-quality content that resonates with our audience.
                    </p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-12 text-center">
                <a href="/contact" class="inline-block px-6 py-3 bg-neutral-900 text-white rounded-md hover:bg-neutral-700 transition">Contact Us</a>
            </div>
        </div>
    </section>
    <!-- footer copyright menu -->
    <div class="bg-neutral-100 text-neutral-700 text-sm py-6 sm:py-4">
        <div class="container xl:max-w-6xl mx-auto px-4">
            <!--footer menu-->
            <div
                class="flex max-sm:flex-col items-center sm:justify-between gap-3">
                <!--footer left menu-->
                <ul
                    class="flex max-sm:flex-wrap max-sm:justify-center items-center">
                    <li class="relative">
                        <a href="#" class="first:ps-0 py-2 px-4 hover:text-black">Home</a>
                    </li>
                    <li class="relative">
                        <a href="#" class="first:ps-0 py-2 px-4 hover:text-black">About</a>
                    </li>
                    <li class="relative">
                        <a href="#" class="first:ps-0 py-2 px-4 hover:text-black">Contact</a>
                    </li>
                    <li class="relative">
                        <a href="#" class="first:ps-0 py-2 px-4 hover:text-black">Term Of Use</a>
                    </li>
                </ul>

                <!-- footer copyright -->
                <div class="relative">
                    <p>
                        Copyright JAFIER | Theme by
                        <a href="https://tailwindtemplate.net" target="_blank">Tailnet</a>
                    </p>
                    <!-- removing credit with small donation really helps us. Get pro version for more features -->
                </div>
            </div>
        </div>
    </div>
    </footer>

    <!-- =========={ SCROLL TO TOP }==========  -->
    <a
        href="#"
        class="back-top fixed py-2 px-3 rounded bg-neutral-50 border border-dashed border-neutral-200 text-neutral-500 end-4 bottom-4"
        aria-label="Scroll To Top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!--start::Global javascript (used in all pages)-->
    <script src="vendors/alpinejs/dist/cdn.min.js"></script>

    <!-- theme js -->
    <script src="src/js/script.js"></script>
</body>

</html>