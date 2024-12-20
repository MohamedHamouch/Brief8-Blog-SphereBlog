<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
  $first_name = $_SESSION['first_name'];
  $last_name = $_SESSION['last_name'];
  $role = ($_SESSION['role'] == 2) ? 'user' : 'admin';
  $connected = true;
} else {
  header("Location: ../../index.php");
  exit();
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
          <li><a href="../index.php" class="text-gray-800 hover:bg-[var(--buff)] py-2 px-4 rounded">Home</a></li>
          <li><a href="../articles/articles.php"
              class="text-gray-800 hover:bg-[var(--buff)] py-2 px-4 rounded">Articles</a></li>
          <li class="relative group text-white">
            <a href="../profile/profile.php" class="bg-black hover:bg-black/70 py-2 px-4 rounded-full">
              <i class="fa-solid fa-user"></i><?= " $first_name $last_name" ?></a>
            <ul class="absolute hidden group-hover:block opacity-0 group-hover:opacity-100 transition-opacity duration-300 
                   bg-gray-800 text-white mt-2 rounded shadow-lg w-full">
              <li><a href="../profile/profile.php" class="block px-4 py-2 hover:bg-gray-600 rounded-t">Profile</a></li>
              <?php if ($connected && $role === "admin") { ?>
                <li><a href="../admin/dashboard.php" class="block px-4 py-2 hover:bg-gray-600">Admin Dashboard</a></li>
              <?php } ?>
              <li><a href="../auth/handel_auth/logout.php"
                  class="block px-4 py-2 hover:bg-gray-600 rounded-b">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="min-h-[75vh] flex">

    <!-- Sidebar -->
    <aside id="side-menu" class="w-[20%] bg-blue-900 text-white py-6 px-4">
      <h3 class="text-lg font-bold mb-4">Menu</h3>
      <div class="space-y-4">

        <button data-section="profile"
          class="w-full text-left text-white hover:bg-blue-700 hover:scale-105 hover:shadow-lg transition-all py-2 px-4 rounded">
          <i class="fa-solid fa-user"></i> Profile
        </button>

        <button data-section="postArticle"
          class="w-full text-left text-white hover:bg-blue-700 hover:scale-105 hover:shadow-lg transition-all py-2 px-4 rounded">
          <i class="fa-solid fa-file-circle-plus"></i> Post New Article
        </button>

        <button data-section="historyArticles"
          class="w-full text-left text-white hover:bg-blue-700 hover:scale-105 hover:shadow-lg transition-all py-2 px-4 rounded">
          <i class="fa-solid fa-newspaper"></i> Articles History
        </button>

        <button data-section="historyComments"
          class="w-full text-left text-white hover:bg-blue-700 hover:scale-105 hover:shadow-lg transition-all py-2 px-4 rounded">
          <i class="fa-solid fa-comment"></i> Comments History
        </button>
      </div>
    </aside>


    <!-- Main Content Area -->
    <div class="w-[80%] py-6 px-8">

      <!-- profile -->
      <section id="profile" class="content-section">
        <h2 class="text-2xl text-blue-900 font-bold mb-6">Your Profile</h2>
        <div class="bg-gray-100 p-6 rounded shadow-md">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">First Name</label>
              <p class="bg-white border border-gray-300 rounded-md py-2 px-4 mt-1 shadow-sm">John</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Last Name</label>
              <p class="bg-white border border-gray-300 rounded-md py-2 px-4 mt-1 shadow-sm">Doe</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Email</label>
              <p class="bg-white border border-gray-300 rounded-md py-2 px-4 mt-1 shadow-sm">john.doe@example.com</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Role</label>
              <p class="bg-white border border-gray-300 rounded-md py-2 px-4 mt-1 shadow-sm">User</p>
            </div>
          </div>
        </div>
      </section>

      <!-- add article -->
      <section id="postArticle" class="content-section hidden">
        <h2 class="text-2xl text-blue-900 font-bold mb-4">Post New Article</h2>
        <form action="/submit-article" method="POST" enctype="multipart/form-data"
          class="flex flex-col gap-5 bg-white p-6 rounded-lg shadow-md">
          <div>
            <label for="title" class="block text-lg font-medium">Title</label>
            <input type="text" id="title" name="title" maxlength="100" required
              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300"
              placeholder="Enter article title (max 100 characters)">
          </div>

          <div>
            <label for="description" class="block text-lg font-medium">Description</label>
            <textarea id="description" name="description" maxlength="250" required rows="2"
              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300"
              placeholder="Enter article description (max 250 characters)"></textarea>
          </div>

          <div>
            <label for="content" class="block text-lg font-medium">Content</label>
            <textarea id="content" name="content" required rows="6"
              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300"
              placeholder="Write your article content here"></textarea>
          </div>

          <div>
            <label for="image" class="block text-lg font-medium">Upload Image</label>
            <input type="file" id="image" name="image" accept="image/*" required
              class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
          </div>

          <button type="submit"
            class="w-36 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:ring focus:ring-blue-300 transition">
            Submit Article</button>
        </form>

      </section>

      <!-- articles history -->
      <section id="historyArticles" class="content-section hidden">
        <h2 class="text-2xl text-blue-900 font-bold mb-4">Your Past Articles</h2>
        <div
          class="grid grid-cols-[30%,30%,20%,10%,10%] items-center bg-gray-200 p-2 font-semibold text-gray-700 mx-auto w-[90%]">
          <div>Title</div>
          <div>Publisher</div>
          <div>Date</div>
          <div class="justify-self-center">Edit</div>
          <div class="justify-self-center">Delete</div>
        </div>

        <div
          class="grid grid-cols-[30%,30%,20%,10%,10%] items-center border-b p-2 bg-white hover:bg-gray-100 mx-auto w-[90%] text-gray-900">
          <p>Article Title 1</p>
          <p>Publisher 1</p>
          <p>2024-12-19</p>
          <button class="bg-transparent border-0 p-0">
            <i class="fa-solid fa-pen-to-square text-yellow-500"></i>
          </button>
          <div class="justify-self-center">
            <form action="handle_forms/delete_article.php" method="POST" class="deleteForm">
              <button type="submit" class="bg-transparent border-0 p-0">
                <i class="fa-solid fa-trash text-red-500"></i>
              </button>
            </form>
          </div>
        </div>
      </section>

      <!-- comments history -->
      <section id="historyComments" class="content-section hidden">
        <h2 class="text-2xl text-blue-900 font-bold mb-4">Your Past Comments</h2>
        <div
          class="grid grid-cols-[30%,30%,20%,10%,10%] items-center bg-gray-200 p-2 font-semibold text-gray-700 mx-auto w-[90%]">
          <div>Associated Article</div>
          <div>Publihser</div>
          <div>Date</div>
          <div class="justify-self-center">Edit</div>
          <div class="justify-self-center">Delete</div>
        </div>

        <div
          class="grid grid-cols-[30%,30%,20%,10%,10%] items-center border-b p-2 bg-white hover:bg-gray-100 mx-auto w-[90%] text-gray-900">
          <p>Article Title 1</p>
          <p>User 1</p>
          <p>2024-12-19</p>
          <button class="bg-transparent border-0 p-0">
            <i class="fa-solid fa-pen-to-square text-yellow-500"></i>
          </button>
          <div class="justify-self-center">
            <form action="handle_forms/delete_comment.php" method="POST" class="deleteForm">
              <button type="submit" class="bg-transparent border-0 p-0">
                <i class="fa-solid fa-trash text-red-500"></i>
              </button>
            </form>
          </div>
        </div>
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