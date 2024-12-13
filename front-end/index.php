<?php
require_once __DIR__ . "/../model/model.php";
require_once __DIR__ . "/../model/users.php";
require_once __DIR__ . "/../model/categories.php";
require_once __DIR__ . "/../model/tags.php";
require_once __DIR__ . "/../model/posts.php";

if (!isset($_SESSION['full_name'])) {
  echo "<script>
  window.location.href = 'login.php';
  </script>";
  exit;
}




$Categories = new Categories();
$Tags = new Tags();
$Users = new Users();
$Posts = new Posts();

$CategoriesAll = $Categories->all();
$TagsAll = $Tags->all();
$PostsAll = $Posts->all();

$PostsPopuler = $Posts->PopulerPosts();
$PostsPopuler = array_slice($PostsPopuler, 0, 3);

$CountCategory = count($Categories->all());
$CountTag = count($Tags->all());
$CountPosts = count($Posts->all());
$CountUsers = count($Users->all());

$show_tag = $Tags->show_tag();
$groupedTags = [];
foreach ($show_tag as $tag) {
  $groupedTags[$tag['post_id_pivot']][] = $tag['name_tag'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog News</title>

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
  <style>
    .line-clamp-5 {
      display: -webkit-box;
      -webkit-line-clamp: 5;
      /* Limit to 5 lines */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>

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
            <h2 class="text-4xl md:text-5xl font-medium">BLOG ID.</h2>
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
        <div
          class="z-40 overflow-auto inset-0 w-full h-full fixed bg-black opacity-50"></div>
      </div>
    </div>
  </header>

  <!-- content -->
  <main class="relative">
    <!-- container -->
    <div
      class="container xl:max-w-6xl mx-auto px-4 flex flex-col gap-4 lg:gap-6">
      <!-- hero -->
      <div class="relative pt-4 lg:pt-6 flex flex-col gap-4 lg:gap-6">
        <div
          class="relative overflow-hidden bg-neutral-200 w-full aspect-[1/1] sm:aspect-[3/2] md:aspect-[2/1] flex justify-center items-center">
          <img
            src="src/img/blogs/hero.jpg"
            alt="tailwind blog template"
            class="absolute w-full inset-x-0 bottom-0" />
          <!-- card inside -->
          <div
            class="relative bg-white max-w-[80%] lg:max-w-[60%] md:min-w-[60%] aspect-[1/1] sm:aspect-[3/2] md:aspect-[2/1] p-4 sm:p-6 text-center">
            <div
              class="h-full flex flex-col items-center gap-2 sm:gap-3 ">
              <span class="uppercase text-sm text-neutral-500">May 12, 2024</span>
              <h1 class="text-2xl sm:text-3xl md:text-4xl font-medium">
                What's BLOG ID.? </h1>
              <p class="text-neutral-500 mb-2">
                BLOG ID is a web platform designed to be a space to share stories, insights and inspiration from a variety of interesting topics. From technology, travel, food, to lifestyle and creativity, BLOG ID brings relevant and informative content to its readers. </p>
              <a
                href="#"
                class="inline-flex py-2 px-4 bg-neutral-100 hover:bg-neutral-200/80 border border-dashed border-neutral-200 mb-2">Read More</a>
            </div>
          </div>
        </div>

        <!-- grids -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6">
          <!-- card item -->
          <div
            class="relative aspect-[2/1] overflow-hidden flex justify-center items-center">
            <img
              src="src/img/blogs/3.jpg"
              class="absolute w-full inset-x-0 top-0"
              alt="image" />
            <!-- category -->
            <a href="#" class="relative flex py-2 px-4 bg-white/80">
              Foods &amp; Travel
            </a>
          </div>
          <!-- card item -->
          <div
            class="relative aspect-[2/1] overflow-hidden flex justify-center items-center">
            <img
              src="src/img/blogs/6.jpg"
              class="absolute w-full inset-x-0 top-0"
              alt="image" />
            <!-- category -->
            <a href="#" class="relative flex py-2 px-4 bg-white/80">
              Product Review
            </a>
          </div>
          <!-- card item -->
          <div
            class="relative aspect-[2/1] overflow-hidden flex justify-center items-center">
            <img
              src="src/img/blogs/7.jpg"
              class="absolute w-full inset-x-0 top-0"
              alt="image" />
            <!-- category -->
            <a href="#" class="relative flex py-2 px-4 bg-white/80">
              Daily Vlog
            </a>
          </div>
        </div>
      </div>

      <!-- layout -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 py-6">
        <!-- sidebar -->
        <aside class="max-lg:order-2 lg:col-span-1 lg:pe-6">
          <div class="flex flex-col gap-4 lg:gap-6 hc-sticky">
            <!-- widget -->
            <div
              class="bg-neutral-50 border border-dashed border-neutral-200">
              <h3
                class="w-full px-6 py-3 border-b border-dashed border-neutral-200">
                Category
              </h3>
              <div class="py-3 px-6">
                <ul class="flex flex-col">
                  <?php foreach ($CategoriesAll as $Category): ?>

                    <a href="">
                      <li
                        class="py-2 px-4 bg-white hover:bg-neutral-100 border border-neutral-200">
                        <?= $Category['name_category'] ?>
                      </li>
                    </a>

                  <?php endforeach ?>

                </ul>
              </div>
            </div>

            <!-- widget -->
            <div
              class="bg-neutral-50 border border-dashed border-neutral-200">
              <h3
                class="w-full px-6 py-3 border-b border-dashed border-neutral-200">
                Recent Posts
              </h3>
              <div class="p-6 flex flex-col">
                <!-- item -->
                <a
                  href="#"
                  class="flex gap-2 border-b border-dashed last:border-b-0 border-neutral-200">
                  <?php foreach ($PostsPopuler as $Post): ?>
                    <a href="#" class="flex gap-2 py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                      <img
                        src="./../assets/img/posts/<?= htmlspecialchars($Post['image']) ?>"
                        alt="image"
                        class="size-16" />
                      <div class="flex flex-col gap-1">
                        <h4 class="text-sm capitalize hover:text-black">
                          <?= htmlspecialchars($Post['title']) ?>
                        </h4>
                      </div>
                    </a>
                  <?php endforeach; ?>
                </a>

              </div>
            </div>

            <!-- widget -->
            <section class="bg-neutral-50 border border-dashed border-neutral-200 p-6 my-6">
              <div x-data="{ dropdown: false }" class="relative">
                <button @click="dropdown = !dropdown"
                  class="w-full py-2 px-4 flex justify-between items-center bg-white border border-neutral-200 rounded-md hover:bg-neutral-100 transition">
                  <span class="uppercase text-neutral-700">Tags</span>
                  <i class="bi" :class="dropdown ? 'bi-chevron-up' : 'bi-chevron-down'"></i>
                </button>
                <ul x-show="dropdown" @click.outside="dropdown = false"
                  class="absolute mt-2 w-full bg-white border border-neutral-200 rounded-md shadow-md z-10 max-h-40 overflow-y-auto">
                  <?php foreach ($TagsAll as $Tags): ?>
                    <li>
                      <a href="#"
                        class="block py-2 px-4 border-neutral-200 rounded-md hover:bg-neutral-100 transition">
                        <?= htmlspecialchars($Tags['name_tag']); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </section>

            <!-- widget -->
          </div>
        </aside>

        <div class="max-lg:order-1 max-lg:mb-12 lg:col-span-2">
          <h2
            class="text-lg uppercase font-medium border-b border-dashed border-neutral-200 pb-2">
            POSTS
          </h2>
          <!-- loop post -->
          <div class="flex flex-col">
            <!-- post item -->

            <article class="gap-4 md:gap-6 py-8 border-b border-dashed border-neutral-200 last:border-b-0">
              <?php
              // Pagination logic
              $postsPerPage = 3;
              $totalPosts = count($PostsAll);
              $totalPages = ceil($totalPosts / $postsPerPage);
              $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $currentPage = max(1, min($totalPages, $currentPage)); // Ensure the page is within bounds

              $startIndex = ($currentPage - 1) * $postsPerPage;
              $currentPosts = array_slice($PostsAll, $startIndex, $postsPerPage);

              foreach ($currentPosts as $Post): ?>
                <div class="grid grid-cols-2 gap-2 ">
                  <img class="rounded-md w-full h-24" src="./../assets/img/posts/<?php echo htmlspecialchars($Post['image']); ?>" alt="image" />
                  <a href="./single-fullwidth.php" class="flex items-start gap-4 py-4 border-b border-dashed last:border-b-0 border-neutral-200">
                    <div class="flex flex-col gap-2 w-2/3">
                      <h4 class="text-sm font-bold capitalize hover:text-black">
                        <?php echo htmlspecialchars($Post['title']); ?>
                      </h4>
                      <span class="text-neutral-500 text-sm line-clamp-5 overflow-hidden">
                        <?php echo htmlspecialchars($Post['content']); ?>
                      </span>
                    </div>
                </div>
                </a>
              <?php endforeach; ?>

              <!-- Pagination Controls -->
              <div class="flex justify-center items-center mt-6 gap-2">
                <?php if ($currentPage > 1): ?>
                  <a href="?page=<?php echo $currentPage - 1; ?>" class="px-3 py-1 border rounded-md bg-neutral-100 hover:bg-neutral-200">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                  <a href="?page=<?php echo $i; ?>" class="px-3 py-1 border rounded-md <?php echo $i === $currentPage ? 'bg-neutral-300' : 'bg-neutral-100 hover:bg-neutral-200'; ?>">
                    <?php echo $i; ?>
                  </a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                  <a href="?page=<?php echo $currentPage + 1; ?>" class="px-3 py-1 border rounded-md bg-neutral-100 hover:bg-neutral-200">Next</a>
                <?php endif; ?>
              </div>
            </article>
          </div>

          <!-- navigation -->
          <div
            class="flex items-center justify-end gap-3 py-4 border-t border-dashed border-neutral-200">
            <a
              class="uppercase text-neutral-500 hover:text-black flex items-center text-sm gap-2"
              href="#">Older Posts <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- footer -->
  <footer>
    <!--Footer content-->
    <div
      class="bg-neutral-100 text-neutral-700 py-8 md:py-12 border-b border-dashed border-neutral-200">
      <div class="container xl:max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
          <!-- widget -->
          <div class="relative flex flex-col gap-3">
            <h3
              class="text-lg font-medium border-b border-dashed border-neutral-200 pb-2">
              About Us
            </h3>
            <p>
              BLOG ID is a web platform designed to be a space to share stories, insights and inspiration from a variety of interesting topics. From technology, travel, food, to lifestyle and creativity, BLOG ID brings relevant and informative content to its readers. </p>

            </p>
            <address>
              <i class="bi bi-geo-alt me-2"></i>Bojonegoro, Jawa Timur, Indonesia
            </address>
            <p class="footer-info">
              <i class="bi bi-phone me-2"></i>+62 877-875-056 88
            </p>
            <p class="footer-info">
              <i class="bi bi-envelope me-2"></i>muhjafart456@gmail.com
            </p>
          </div>

          <!-- widget -->
          <div class="relative flex flex-col gap-3">
            <h3
              class="text-lg font-medium border-b border-dashed border-neutral-200 pb-2">
              Featured Posts
            </h3>
            <div class="flex flex-col">
              <a
                href="#"
                class="flex gap-2 py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <img src="src/img/blogs/2.jpg" alt="image" class="size-16" />
                <div class="flex flex-col gap-1">
                  <h4 class="text-sm capitalize hover:text-black">
                    The Tourist Destination That You Must Visit ...
                  </h4>
                  <span class="text-neutral-500 text-sm">12 May, 2024</span>
                </div>
              </a>

              <a
                href="#"
                class="flex gap-2 py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <img src="src/img/blogs/8.jpg" alt="image" class="size-16" />
                <div class="flex flex-col gap-1">
                  <h4 class="text-sm capitalize hover:text-black">
                    Embracing A Leisurely Pace In A ...
                  </h4>
                  <span class="text-neutral-500 text-sm">12 May, 2024</span>
                </div>
              </a>


            </div>
          </div>

          <!-- widget -->
          <div class="relative flex flex-col gap-3">
            <h3
              class="text-lg font-medium border-b border-dashed border-neutral-200 pb-2">
              Recent Posts
            </h3>
            <div class="flex flex-col">
              <a
                href="#"
                class="py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <div class="flex flex-col gap-1">
                  <h4 class="text-sm font-medium capitalize hover:text-black">
                    Master Photography: Tips For Capturing Stunning Moments
                  </h4>
                  <span class="text-neutral-500 text-sm">12 May, 2024</span>
                </div>
              </a>

              <a
                href="#"
                class="py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <div class="flex flex-col gap-1">
                  <h4 class="text-sm font-medium capitalize hover:text-black">
                    The Tourist Destination That You Must Visit While On
                    Vacation In Bali
                  </h4>
                  <span class="text-neutral-500 text-sm">12 May, 2024</span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

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
              <a href="index.php" class="first:ps-0 py-2 px-4 hover:text-black">Home</a>
            </li>
            <li class="relative">
              <a href="about.php" class="first:ps-0 py-2 px-4 hover:text-black">About</a>
            </li>
            <li class="relative">
              <a href="contact.php" class="first:ps-0 py-2 px-4 hover:text-black">Contact</a>
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