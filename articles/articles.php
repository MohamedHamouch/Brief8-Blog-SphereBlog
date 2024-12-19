<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
  $first_name = $_SESSION['first_name'];
  $last_name = $_SESSION['last_name'];
  $role = ($_SESSION['role'] == 2) ? 'user' : 'admin';
  $connected = true;
} else {
  $connected = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlogSphere - Articles</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link rel="stylesheet" href="../styles.css">

  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <header class="bg-[var(--light)] py-4 h-[10vh] sticky top-0">
    <div class="mx-auto flex justify-between items-center">
      <button class="logo">
        <img src="../assets/sphereblog.png" alt="Logo" class="w-28">
      </button>
      <nav class="nav px-2">
        <ul class="flex gap-1">
          <li><a href="../index.php" class="text-gray-800 hover:bg-[var(--buff)] py-2 px-4 rounded">Home</a></li>
          <li><a href="articles.php" class="text-gray-800 bg-[var(--buff)] py-2 px-4 rounded">Articles</a>
          </li>
          <?php
          if (!$connected) {
            echo '<li><a href="../auth/login.php" class="text-white bg-black hover:bg-black/70 py-2 px-4 rounded-full">
            <i class="fa-solid fa-user-plus"></i> Authentification</a></li>';
          } else {
            ?>
            <li class="relative group text-white">
              <a href="../profile/profile.php" class="bg-black hover:bg-black/70 py-2 px-4 rounded-full">
                <i class="fa-solid fa-user"></i><?= " $first_name $last_name" ?>
              </a>
              <ul class="absolute hidden group-hover:block opacity-0 group-hover:opacity-100 transition-opacity duration-300 
                   bg-gray-800 text-white mt-2 rounded shadow-lg w-full">
                <li><a href="../profile/profile.php" class="block px-4 py-2 hover:bg-gray-600 rounded-t">Profile</a></li>
                <?php if ($role === "admin") { ?>
                  <li><a href="../admin/dashboard.php" class="block px-4 py-2 hover:bg-gray-600">Admin Dashboard</a></li>
                <?php } ?>
                <li><a href="../auth/handel_auth/logout.php"
                    class="block px-4 py-2 hover:bg-gray-600 rounded-b">Logout</a></li>
              </ul>
            </li>
            <?php
          }
          ?>

        </ul>
      </nav>
    </div>
  </header>

  <section class="bg-[var(--medium)] h-[35vh] flex flex-col justify-center text-center">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-gray-800 mb-4">Explore Our Articles</h2>
      <p class="text-lg text-gray-600 mb-8">Discover insights, stories, and knowledge shared by our community.</p>
      <?php
      if (!$connected) {
        echo '<a href="../auth/login.php" class="bg-[var(--black)] text-white py-2 px-6 rounded hover:opacity-70 transition duration-300">Get Started</a>';
      } else {
        echo '<a href="../profile/profile.php" class="bg-[var(--black)] text-white py-2 px-6 rounded hover:opacity-70 transition duration-300">Check profile</a>';
      }
      ?>
    </div>
  </section>

  <section class="py-20 min-h-[40vh] bg-white">
    <div class="container mx-auto text-center flex flex-col gap-12">
      <h1 class="text-3xl font-bold text-gray-800">All Articles</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

        <div class="bg-gray-100 p-6 rounded shadow-md hover:shadow-lg transition duration-300 max-w-xs mx-auto">
          <p class="text-xl font-semibold text-gray-800 mb-4">Article Title 1</p>
          <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <p class="text-xs text-[var(--black)] mb-2 font-semibold">12/12/2024</p>
          <a href="#" class="text-[var(--blue)] hover:text-[var(--buff)] font-bold">Read More</a>
        </div>

        <div class="bg-gray-100 p-6 rounded shadow-md hover:shadow-lg transition duration-300 max-w-xs mx-auto">
          <p class="text-xl font-semibold text-gray-800 mb-4">Article Title 2</p>
          <p class="text-gray-600 mb-4">Vivamus lacinia, purus eu vehicula lacinia.</p>
          <a href="#" class="text-[var(--blue)] hover:text-[var(--buff)] font-bold">Read More</a>
        </div>

        <div class="bg-gray-100 p-6 rounded shadow-md hover:shadow-lg transition duration-300 max-w-xs mx-auto">
          <p class="text-xl font-semibold text-gray-800 mb-4">Article Title 3</p>
          <p class="text-gray-600 mb-4">Curabitur nec nisi et arcu feugiat posuere.</p>
          <a href="#" class="text-[var(--blue)] hover:text-[var(--buff)] font-bold">Read More</a>
        </div>
      </div>

    </div>

  </section>

  <footer class="bg-[#ffe5cf] py-4 px-2 h-[15vh]">
    <div class="container mx-auto flex justify-between items-center">
      <div class="logo">
        <img src="../assets/sphereblog.png" alt="Logo" class="w-24">
      </div>

      <nav>
        <ul class="flex space-x-8">
          <li><a href="#" class="text-gray-800 hover:text-[#e8b28b]">Home</a></li>
          <li><a href="#" class="text-gray-800 hover:text-[#e8b28b]">Articles</a></li>
          <li><a href="#" class="text-gray-800 hover:text-[#e8b28b]">Contact</a></li>
        </ul>
      </nav>
    </div>
    <div class="text-center text-xs mt-8">
      <p class="text-gray-800">© 2024 Your Platform. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>