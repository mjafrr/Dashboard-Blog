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
$UsersAll = $Users->all();

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

$show_categories = $Categories->show_categories();
$groupedCategories = [];
foreach ($show_categories as $Categories) {
  $groupedCategories[$Categories['post_id_pivot']][] = $Categories['name_category'];
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
    h2 {
      margin-top: 20px;
      margin-bottom: 15px;
    }

    p {
      margin: 0;
      padding: 10px;
      background-color: #f4f4f4;
      border-radius: 5px;
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
            <a href="about.php" class="py-1.5 px-3 hover:text-neutral-900">About</a>
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

          <a href="index.html" class="py-4 md:py-6 lg:py-12">
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
                  href="category.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Category</a>
              </li>
              <li>
                <a
                  href="single.html"
                  class="flex px-4 py-1.5 hover:bg-neutral-100">Single Post</a>
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
                  href="contact.html"
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
    <div
      class="container xl:max-w-6xl mx-auto px-4 flex flex-col gap-4 lg:gap-6">
      <!-- layout -->
      <div class="grid grid-cols-1 py-6">
        <div class="relative">
          <h1
            class="text-2xl md:text-3xl lg:text-4xl md:text-center font-extrabold py-4 ">
            <?= $PostsAll[0]['title'] ?>
          </h1>
          <!-- data -->
          <div
            class="pb-4 w-full flex items-center md:justify-center gap-4 text-sm text-neutral-500 border-b border-dashed border-neutral-200">
            <!--author-->
            <a href="#" rel="author"><i class="bi bi-person me-2"><?= $UsersAll[0]['full_name'] ?></i></a>
            <!--date-->
            <time class="news-date" datetime="2024-06-16"><i class="bi bi-calendar me-2"> <?= $PostsAll[0]['created_at'] ?>
              </i></time>
            <!--categories-->
            <a href="#" rel="categories"><i class="bi bi-bookmark me-2"></i><?= $show_categories[0]['name_category'] ?> </a>
          </div>

          <!-- post -->
          <div class="relative post-content pt-4">
            <p>
              Exploring street foods around the world is an adventure for your
              taste buds. From savory to sweet, spicy to tangy, each bite
              tells a story of culture, tradition, and culinary creativity.
              Here's a list of the top 10 must-try street foods that will take
              you on a delicious journey across continents.
            </p>
            <div
              class="aspect-[2/1] overflow-hidden w-full bg-neutral-100 mb-8">
              <img
                src="./../assets/img/posts/<?= $PostsAll[0]['image'] ?>"
                alt="Post image"
                class="w-full" />
            </div>

            <h2>
              <?= $PostsAll[0]['title'] ?>
            </h2>
            <p>
              <?= $PostsAll[0]['content'] ?>
            </p>
            <p>

            <div class="tags">
              <strong>Tags:</strong>
              <?php if (!empty($groupedTags[$postId])): ?>
                <?php foreach ($groupedTags[$postId] as $tag): ?>
                  <span class="tag"><?= htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
              <?php else: ?>
                <span>Tidak ada tag</span>
              <?php endif; ?>

            </div>

            </p>


          </div>

          <!-- navigation -->
          <div
            class="flex flex-col sm:flex-row items-center justify-between gap-3 py-4 border-y border-dashed border-neutral-200">
            <!-- categories -->
            <ul class="flex flex-wrap items-center gap-2 text-sm">
              <li><i class="bi bi-tags"></i> :</li>
              <?php foreach ($CategoriesAll as $Category): ?>

                <a href="">
                  <li
                    class="flex py-1 px-3 bg-white hover:bg-neutral-100 border border-neutral-200">
                    <?= $Category['name_category'] ?>
                  </li>
                </a>

              <?php endforeach ?>

            </ul>

            <!-- share -->
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

          <!-- profile -->
          <div
            class="flex flex-row items-center py-6 md:py-8 border-b border-dashed border-neutral-200">
            <div class="rounded-full overflow-hidden">
              <a href="#">
                <img
                  src="./../assets/img/users/<?= $UsersAll[0]['avatar'] ?>"
                  alt=""
                  class="size-20 rounded-full mb-2" />
              </a>
            </div>
            <div class="ms-6">
              <!--name-->
              <h4 class="text-xl"><?= $UsersAll[0]['full_name'] ?></h4>
              <!-- website -->
              <p>
                <a
                  target="_blank"
                  class="hover:text-black"
                  rel="noopener"
                  href="https://tailwindtemplate.net">https://tailwindtemplate.net</a>
              </p>
              <!--description-->
              <p class="hidden sm:block">
                Programmer, Developer, I design and develop Tailwind template,
                founder of Tailnet
              </p>
              <!--social-->
              <div class="mt-2">
                <ul class="space-x-3">
                  <!--facebook-->
                  <li class="inline-block">
                    <a
                      target="_blank"
                      class="hover:text-neutral-900"
                      rel="noopener noreferrer"
                      href="https://facebook.com"
                      title="Facebook">
                      <i class="bi bi-facebook text-xl"></i>
                    </a>
                  </li>
                  <!--twitter-->
                  <li class="inline-block">
                    <a
                      target="_blank"
                      class="hover:text-neutral-900"
                      rel="noopener noreferrer"
                      href="https://twitter.com"
                      title="Twitter">
                      <i class="bi bi-twitter text-xl"></i>
                    </a>
                  </li>
                  <!--youtube-->
                  <li class="inline-block">
                    <a
                      target="_blank"
                      class="hover:text-neutral-900"
                      rel="noopener noreferrer"
                      href="https://youtube.com"
                      title="Youtube">
                      <i class="bi bi-linkedin text-xl"></i>
                    </a>
                  </li>
                  <!--instagram-->
                  <li class="inline-block">
                    <a
                      target="_blank"
                      class="hover:text-neutral-900"
                      rel="noopener noreferrer"
                      href="https://instagram.com"
                      title="Instagram">
                      <i class="bi bi-tiktok text-xl"></i>
                    </a>
                  </li>
                  <!--end instagram-->
                </ul>
              </div>
              <!--end social-->
            </div>
          </div>
          <div
            class="flex flex-row items-center py-6 md:py-8 border-b border-dashed border-neutral-200">
            <div class="rounded-full overflow-hidden">
              <a href="#">
                <img
                  src="./../assets/img/users/<?= $UsersAll[0]['avatar'] ?>"
                  alt=""
                  class="size-20 rounded-full mb-2" />
              </a>
            </div>
            <div class="ms-6">
              <!--name-->
              <h4 class="text-xl"><?= $UsersAll[0]['full_name'] ?></h4>
              <!-- website -->
              <p>
                <a
                  target="_blank"
                  class="hover:text-black"
                  rel="noopener"
                  href="https://tailwindtemplate.net">https://tailwindtemplate.net</a>
              </p>
              <!--description-->
              <p class="hidden sm:block">
                Programmer, Developer, I design and develop Tailwind template,
                founder of Tailnet
              </p>
              <!--social-->
              <div class="mt-2">
                <ul class="space-x-3">
                  <!--facebook-->
                  <li class="inline-block">
                    <a
                      target="_blank"
                      class="hover:text-neutral-900"
                      rel="noopener noreferrer"
                      href="https://facebook.com"
                      title="Facebook">
                      <i class="bi bi-facebook text-xl"></i>
                    </a>
                  </li>
                  <!--twitter-->
                  <li class="inline-block">
                    <a
                      target="_blank"
                      class="hover:text-neutral-900"
                      rel="noopener noreferrer"
                      href="https://twitter.com"
                      title="Twitter">
                      <i class="bi bi-twitter text-xl"></i>
                    </a>
                  </li>
                  <!--youtube-->
                  <li class="inline-block">
                    <a
                      target="_blank"
                      class="hover:text-neutral-900"
                      rel="noopener noreferrer"
                      href="https://youtube.com"
                      title="Youtube">
                      <i class="bi bi-linkedin text-xl"></i>
                    </a>
                  </li>
                  <!--instagram-->
                  <li class="inline-block">
                    <a
                      target="_blank"
                      class="hover:text-neutral-900"
                      rel="noopener noreferrer"
                      href="https://instagram.com"
                      title="Instagram">
                      <i class="bi bi-tiktok text-xl"></i>
                    </a>
                  </li>
                  <!--end instagram-->
                </ul>
              </div>
              <!--end social-->
            </div>
          </div>

          <!-- related -->
          <div class="py-6 md:py-8 border-b border-dashed border-neutral-200">
            <h3 class="text-xl w-full">Related Article</h3>
            <div class="pt-2 flex flex-col">
              <!-- item -->
              <a
                href="#"
                class="flex gap-3 py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <img src="src/img/blogs/8.jpg" alt="image" class="size-16" />
                <div class="flex flex-col gap-1">
                  <h4 class="capitalize hover:text-black">
                    Embracing A Leisurely Pace In A Fast-Paced ...
                  </h4>
                  <span class="text-neutral-500 text-sm">12 May, 2024</span>
                </div>
              </a>
              <!-- item -->
              <a
                href="#"
                class="flex gap-3 py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <img src="src/img/blogs/2.jpg" alt="image" class="size-16" />
                <div class="flex flex-col gap-1">
                  <h4 class="capitalize hover:text-black">
                    How To Stay Productive While Traveling For ...
                  </h4>
                  <span class="text-neutral-500 text-sm">12 May, 2024</span>
                </div>
              </a>
              <!-- item -->
              <a
                href="#"
                class="flex gap-3 py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <img src="src/img/blogs/5.jpg" alt="image" class="size-16" />
                <div class="flex flex-col gap-1">
                  <h4 class="capitalize hover:text-black">
                    Master Photography: Tips For Capturing ...
                  </h4>
                  <span class="text-neutral-500 text-sm">12 May, 2024</span>
                </div>
              </a>
            </div>
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
              Neutral is a Tailwind blog template for personal and blog site.
              This demo is crafted specifically to exhibit the use of the
              theme as a blog site. Visit our main page for more demos.
            </p>
            <address>
              <i class="bi bi-geo-alt me-2"></i>Amphitheatre, Mountain View,
              San Francisco, CA 9321, United States
            </address>
            <p class="footer-info">
              <i class="bi bi-phone me-2"></i>+(123) 456-7890
            </p>
            <p class="footer-info">
              <i class="bi bi-envelope me-2"></i>support@example.com
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

              <a
                href="#"
                class="flex gap-2 py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <img src="src/img/blogs/6.jpg" alt="image" class="size-16" />
                <div class="flex flex-col gap-1">
                  <h4 class="text-sm capitalize hover:text-black">
                    How To Work And Travel Successfully In The ...
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
              Popular Posts
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

              <a
                href="#"
                class="py-3 border-b border-dashed last:border-b-0 border-neutral-200">
                <div class="flex flex-col gap-1">
                  <h4 class="text-sm font-medium capitalize hover:text-black">
                    Exploring The Virtual Reality: A Technological Revolution
                    In Travel
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