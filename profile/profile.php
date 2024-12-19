<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
  $first_name = $_SESSION['first_name'];
  $last_name = $_SESSION['last_name'];
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
  <title>BlogSphere - Profile</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link rel="stylesheet" href="../styles.css">

  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <header class="bg-[var(--light)] py-4 h-[10vh] sticky top-0">
    <div class="mx-auto flex justify-between items-center">
      <button class="logo">
        <img src="../assets/sphereblog.png" alt="Logo" class="w-28">
      </button>
      <nav class="nav px-2">
        <ul class="flex gap-1">
          <li><a href="../index.php" class="text-gray-800 hover:bg-[var(--buff)] py-2 px-4 rounded">Home</a>
          </li>
          <li><a href="#" class="text-gray-800 hover:bg-[var(--buff)] py-2 px-4 rounded">Articles</a>
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
                <li><a href="../auth/handel_forms/logout.php"
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

  <main class="min-h-[75vh] flex">

    <!-- Sidebar -->
    <aside class="w-[15%] bg-gray-800 text-white py-6 px-4">
      <h3 class="text-lg font-semibold mb-4">Menu</h3>
      <div class="space-y-4">

        <button
          class="w-full text-left text-white hover:bg-[#e8b28b]/20 hover:scale-105 hover:shadow-lg transition-all py-2 px-4 rounded">
          <i class="fa-solid fa-user"></i> Profile
        </button>


        <button
          class="w-full text-left text-white hover:bg-[#e8b28b]/20 hover:scale-105 hover:shadow-lg transition-all py-2 px-4 rounded">
          <i class="fa-solid fa-file-circle-plus"></i> Post New Article
        </button>

        <button
          class="w-full text-left text-white hover:bg-[#e8b28b]/20 hover:scale-105 hover:shadow-lg transition-all py-2 px-4 rounded">
          <i class="fa-solid fa-newspaper"></i> Past Articles
        </button>

        <button
          class="w-full text-left text-white hover:bg-[#e8b28b]/20 hover:scale-105 hover:shadow-lg transition-all py-2 px-4 rounded">
          <i class="fa-solid fa-comment"></i> Past Comments
        </button>
      </div>
    </aside>


    <!-- Main Content Area -->
    <div class="w-[85%] py-6 px-8">
      <section id="dashboard" class="content-section">
        <h2 class="text-2xl font-semibold mb-4">Your Profile</h2>
      </section>

      <section id="postArticle" class="content-section hidden">
        <h2 class="text-2xl font-semibold mb-4">Post New Article</h2>
      </section>

      <section id="pastArticles" class="content-section hidden">
        <h2 class="text-2xl font-semibold mb-4">Your Past Articles</h2>
      </section>

      <section id="pastComments" class="content-section hidden">
        <h2 class="text-2xl font-semibold mb-4">Your Past Comments</h2>
      </section>
    </div>
  </main>

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

  <script src="profile.js"></script>
</body>

</html>