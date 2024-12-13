<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Neutral - Tailwind Blog Template</title>

  <!-- Custom styles -->
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

<body class="text-neutral-700 font-sans">
  <!-- header -->
  <header x-data="{ navtoggle: false }" class="flex flex-col">
    <!-- top -->
    <div class="border-b border-dashed border-neutral-200">
      <div
        class="container xl:max-w-6xl mx-auto px-4 flex items-center justify-between gap-3">
        <ul
          class="max-sm:grow max-sm:overflow-hidden flex items-center text-sm">
          <li class="relative">
            <a href="index.html" class="py-1.5 px-3 hover:text-neutral-900">Home</a>
          </li>
          <li class="relative">
            <a href="profile.html" class="py-1.5 px-3 hover:text-neutral-900">Profile</a>
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
            <h2 class="text-4xl md:text-5xl font-medium">CONTACT US</h2>
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
          <!-- dropdown -->
          <li
            x-data="{ dropdown: false }"
            class="relative md:[&_>button]:hover:bg-neutral-100">
            <button
              @click="dropdown = ! dropdown"
              :class="! dropdown ? '' : 'bg-neutral-100'"
              class="uppercase w-full py-2 px-4 flex max-md:justify-between gap-2 [&.active]:text-black [&.active]:bg-neutral-100 hover:text-black hover:bg-neutral-100">
              Pages<i
                :class="! dropdown ? '' : 'show'"
                class="[&.show]:-rotate-180 transition duration-400 bi bi-chevron-down"></i>
            </button>

            <ul
              x-show="dropdown"
              x-transition.duration.500ms
              :class="! dropdown ? '' : 'show'"
              @click.outside="dropdown = false"
              class="[&.show]:!opacity-100 [&.show]:!visible max-md:[&.show]:!h-auto max-md:h-0 opacity-0 invisible dropdown-menu md:z-50 relative md:absolute capitalize md:top-full end-0 md:-end-1/4 min-w-40 bg-white border border-dashed border-neutral-200">
              <li>
                <a
                  href="posts.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Posts</a>
              </li>

              <li>
                <a
                  href="single-fullwidth.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Fullwidth</a>
              </li>
              <li>
                <a
                  href="page.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Page</a>
              </li>
              <li>
                <a
                  href="contact.php"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Contact</a>
              </li>
              <li>
                <a
                  href="author.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Author</a>
              </li>
              <li>
                <a
                  href="search.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Search</a>
              </li>
              <li>
                <a
                  href="tags.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Tags</a>
              </li>
              <li>
                <a
                  href="404.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">404</a>
              </li>
            </ul>
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
        <div
          class="z-40 overflow-auto inset-0 w-full h-full fixed bg-black opacity-50"></div>
      </div>
    </div>
  </header>

  <!-- content -->
  <main class="relative">
    <!-- container -->
    <div class="container xl:max-w-6xl mx-auto px-4 flex flex-col gap-8 py-8">
      <!-- layout -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- sidebar -->
        <aside class="max-lg:order-2 lg:col-span-1 lg:pe-6">
          <div class="flex flex-col gap-6 hc-sticky">
            <!-- Add sidebar content if needed -->
          </div>
        </aside>

        <!-- main content -->
        <div class="max-lg:order-1 lg:col-span-2 bg-neutral-50 p-8 rounded-lg shadow-md">
          <!-- post -->
          <div class="relative post-content text-center p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Contact Us</h2>
            <p class="mb-6 text-gray-600 leading-relaxed">
              Thank you for your interest in reaching out to us! At <span class="text-black font-semibold">BLOG ID.</span>, we value your feedback, inquiries, and suggestions. Our dedicated team is here to assist you.
            </p>

            <p class="mb-6 text-gray-600">Feel free to get in touch with us through the following channels:</p>

            <div class="flex flex-col gap-4 mb-8 text-left lg:text-center">
              <div class="flex items-center gap-3"><i class="bi bi-envelope text-xl text-blue-600"></i> <span>Support@mail.com</span></div>
              <div class="flex items-center gap-3"><i class="bi bi-telephone text-xl text-green-600"></i> <span>(+123) 456 7890</span></div>
              <div class="flex items-center gap-3"><i class="bi bi-whatsapp text-xl text-green-500"></i> <span>(+123) 456 7890</span></div>
              <div class="flex items-center gap-3"><i class="bi bi-skype text-xl text-blue-500"></i> <span>Support@mail.com</span></div>
            </div>

            <!-- Contact Form -->
            <div id="comment-form">
              <h3 class="text-xl font-semibold mb-4 text-gray-800">Send Us a Message</h3>
              <p class="mb-6 text-gray-600">
                We strive to respond to all emails promptly and ensure that your questions are answered thoroughly.
              </p>

              <form action="#" class="space-y-6">
                <textarea
                  class="w-full p-4 text-gray-700 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none"
                  placeholder="Your Message"
                  aria-label="Your message"
                  rows="4"
                  required></textarea>

                <input
                  type="text"
                  class="w-full p-4 text-gray-700 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none"
                  placeholder="Your Name"
                  aria-label="Your name"
                  required />

                <input
                  type="email"
                  class="w-full p-4 text-gray-700 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none"
                  placeholder="Your Email"
                  aria-label="Your email"
                  required />

                <button
                  type="submit"
                  class="w-full p-4 text-white bg-neutral-900 rounded-lg ">
                  Send Message
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  <!-- footer -->
  <footer>
    <!--Footer content-->

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
              Copyright { Name } | Theme by
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