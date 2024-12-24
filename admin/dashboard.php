<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
  $connected = true;
  $role = ($_SESSION['role'] == 2) ? 'user' : 'admin';

  if ($role === 'admin') {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];

    require 'select_data.php';

  } else {
    header("Location: ../../index.php");
    exit();
  }

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
  <title>BlogSphere - Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link rel="stylesheet" href="../styles.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

  <header class="bg-white shadow-sm fixed w-full z-50">
    <div class="container mx-auto px-4 py-3">
      <div class="flex justify-between items-center">
        <a href="../index.php" class="flex items-center space-x-2">
          <img src="../assets/sphereblog.png" alt="Logo" class="w-24 h-auto">
        </a>

        <nav class="hidden md:flex items-center space-x-6">
          <a href="../index.php" class="text-gray-600 hover:text-orange-500 transition">Home</a>
          <a href="../articles/articles.php" class="text-gray-600 hover:text-orange-500 transition">Articles</a>
          <div class="relative group">
            <button
              class="flex items-center space-x-2 bg-gray-900 text-white px-6 py-2 rounded-full hover:bg-gray-800 transition">
              <i class="fa-solid fa-user"></i>
              <span><?= "$first_name $last_name" ?></span>
            </button>
            <div
              class="absolute right-0 w-48 mt-2 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform">
              <a href="../profile/profile.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
              <a href="dashboard.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Admin Dashboard</a>
              <a href="../auth/handel_auth/logout.php" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Logout</a>
            </div>
          </div>
        </nav>

        <!-- <button class="md:hidden bg-gray-100 p-2 rounded-lg">
          <i class="fas fa-bars text-gray-600"></i>
        </button> -->
      </div>
    </div>
  </header>

  <main class="pt-16 min-h-screen flex">

    <aside id="side-menu" class="w-64 bg-orange-800 text-white fixed h-full">
      <div class="p-6 space-y-4">
        <h3 class="text-lg font-semibold text-gray-200 mb-6">Admin Dashboard</h3>

        <button data-section="profile"
          class="w-full flex items-center space-x-3 text-left text-gray-300 hover:text-white hover:bg-gray-800 py-2.5 px-4 rounded-lg transition-all duration-200">
          <i class="fa-solid fa-user"></i>
          <span>Profile</span>
        </button>

        <button data-section="manageUsers"
          class="w-full flex items-center space-x-3 text-left text-gray-300 hover:text-white hover:bg-gray-800 py-2.5 px-4 rounded-lg transition-all duration-200">
          <i class="fa-solid fa-users"></i>
          <span>Manage Users</span>
        </button>

        <button data-section="manageArticles"
          class="w-full flex items-center space-x-3 text-left text-gray-300 hover:text-white hover:bg-gray-800 py-2.5 px-4 rounded-lg transition-all duration-200">
          <i class="fa-solid fa-newspaper"></i>
          <span>Manage Articles</span>
        </button>

        <button data-section="manageComments"
          class="w-full flex items-center space-x-3 text-left text-gray-300 hover:text-white hover:bg-gray-800 py-2.5 px-4 rounded-lg transition-all duration-200">
          <i class="fa-solid fa-comments"></i>
          <span>Manage Comments</span>
        </button>
      </div>
    </aside>

    <div class="ml-64 flex-1 p-8 bg-gray-50">
      <!-- Profile -->
      <section id="profile" class="content-section">
        <div class="max-w-4xl mx-auto">
          <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Your Profile</h2>
            <p class="mt-2 text-gray-600">View your admin account information</p>
          </div>

          <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-sm font-medium text-gray-600">First Name</label>
                  <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-gray-900 font-medium"><?= $first_name ?></p>
                  </div>
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium text-gray-600">Last Name</label>
                  <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-gray-900 font-medium"><?= $last_name ?></p>
                  </div>
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium text-gray-600">Email</label>
                  <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-gray-900 font-medium"><?= $email ?></p>
                  </div>
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium text-gray-600">Role</label>
                  <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-gray-900 font-medium capitalize"><?= $role ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Manage Users -->
      <section id="manageUsers" class="content-section hidden max-w-5xl mx-auto">
        <div class="mb-8">
          <h2 class="text-3xl font-bold text-gray-900">Manage Users</h2>
          <p class="mt-2 text-gray-600">View and manage user accounts</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          <div
            class="grid grid-cols-[5%,20%,20%,30%,10%,7.5%,7.5%] items-center py-4 px-6 bg-gray-50 border-b border-gray-200">
            <div class="text-sm font-medium text-gray-600">ID</div>
            <div class="text-sm font-medium text-gray-600">First Name</div>
            <div class="text-sm font-medium text-gray-600">Last Name</div>
            <div class="text-sm font-medium text-gray-600">Email</div>
            <div class="text-sm font-medium text-gray-600">Role</div>
            <div class="text-sm font-medium text-gray-600 text-center">Promote</div>
            <div class="text-sm font-medium text-gray-600 text-center">Delete</div>
          </div>

          <div class="divide-y divide-gray-200">
            <?php
            foreach ($users as $user) {
              ?>
              <div
                class="grid grid-cols-[5%,20%,20%,30%,10%,7.5%,7.5%] items-center py-4 px-6 hover:bg-gray-50 transition-colors">
                <div class="text-gray-900"><?= $user['id'] ?></div>
                <div class="text-gray-900"><?= $user['first_name'] ?></div>
                <div class="text-gray-900"><?= $user['last_name'] ?></div>
                <div class="text-gray-900"><?= $user['email'] ?></div>
                <div class="text-gray-900"><?= $user['role_name'] ?></div>
                <div class="flex justify-center">
                  <button class="text-blue-500 hover:text-blue-600 transition-colors">
                    <i class="fa-solid fa-circle-arrow-up"></i>
                  </button>
                </div>
                <div class="flex justify-center">
                  <form action="" method="POST" class="deleteForm">
                    <button type="submit" class="text-red-500 hover:text-red-600 transition-colors">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </div>
              <?php
            } ?>
          </div>
        </div>
      </section>

      <!-- Manage Articles -->
      <section id="manageArticles" class="content-section hidden max-w-5xl mx-auto">
        <div class="mb-8">
          <h2 class="text-3xl font-bold text-gray-900">Manage Articles</h2>
          <p class="mt-2 text-gray-600">View and manage all articles</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="grid grid-cols-[3fr,2fr,2fr,1fr,1fr] items-center py-4 px-6 bg-gray-50 border-b border-gray-200">
            <div class="text-sm font-medium text-gray-600">Title</div>
            <div class="text-sm font-medium text-gray-600">Publisher</div>
            <div class="text-sm font-medium text-gray-600">Date</div>
            <div class="text-sm font-medium text-gray-600 text-center">Edit</div>
            <div class="text-sm font-medium text-gray-600 text-center">Delete</div>
          </div>

          <div class="divide-y divide-gray-200">
            <?php
            foreach ($articles as $article) {
              ?>
              <div class="grid grid-cols-[3fr,2fr,2fr,1fr,1fr] items-center py-4 px-6 hover:bg-gray-50 transition-colors">
                <div class="text-gray-900 font-medium"><?= $article['title'] ?></div>
                <div class="text-gray-600"><?= "{$article['first_name']} {$article['last_name']}" ?></div>
                <div class="text-gray-600"><?= $article['publish_date'] ?></div>
                <div class="flex justify-center">
                  <button class="edit-article-btn text-gray-400 hover:text-orange-500 transition-colors">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                </div>
                <div class="flex justify-center">
                  <form action="handle_forms/delete_article.php" method="POST" class="deleteForm">
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </div>
              <?php
            } ?>
          </div>
        </div>
      </section>

      <!-- Manage Comments -->
      <section id="manageComments" class="content-section hidden max-w-5xl mx-auto">
        <div class="mb-8">
          <h2 class="text-3xl font-bold text-gray-900">Manage Comments</h2>
          <p class="mt-2 text-gray-600">View and manage all comments</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="grid grid-cols-[3fr,2fr,2fr,1fr,1fr] items-center py-4 px-6 bg-gray-50 border-b border-gray-200">
            <div class="text-sm font-medium text-gray-600">Associated Article</div>
            <div class="text-sm font-medium text-gray-600">Publisher</div>
            <div class="text-sm font-medium text-gray-600">Date</div>
            <div class="text-sm font-medium text-gray-600 text-center">Edit</div>
            <div class="text-sm font-medium text-gray-600 text-center">Delete</div>
          </div>

          <div class="divide-y divide-gray-200">
            <?php
            foreach ($comments as $comment) {
              ?>
              <div class="grid grid-cols-[3fr,2fr,2fr,1fr,1fr] items-center py-4 px-6 hover:bg-gray-50 transition-colors">
                <div class="text-gray-900 font-medium"><?= $comment['title'] ?></div>
                <div class="text-gray-600"><?= "{$comment['first_name']} {$comment['last_name']}" ?></div>
                <div class="text-gray-600"><?= $comment['comment_date'] ?></div>
                <div class="flex justify-center">
                  <button class="text-gray-400 hover:text-orange-500 transition-colors">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                </div>
                <div class="flex justify-center">
                  <form action="handle_forms/delete_comment.php" method="POST" class="deleteForm">
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </div>
              <?php
            } ?>
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- edit articl form -->
  <section class="fixed inset-0 z-50 hidden" id="edit-article-form">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>

    <div
      class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="p-6 space-y-6">

        <div class="mb-8">
          <h2 class="text-3xl font-bold text-gray-900">Edit Article</h2>
          <p class="mt-2 text-gray-600">Update your article information</p>
        </div>

        <form action="handle_forms/update_article.php" method="POST" class="space-y-6">
          <input type="hidden" name="article_id" id="edit-article-id">

          <div class="space-y-2">
            <label for="edit-title" class="text-sm font-medium text-gray-600">Title</label>
            <input type="text" id="edit-title" name="title" maxlength="100" required
              class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-colors"
              placeholder="Enter article title (max 100 characters)">
          </div>

          <div class="space-y-2">
            <label for="edit-description" class="text-sm font-medium text-gray-600">Description</label>
            <textarea id="edit-description" name="description" maxlength="250" required rows="2"
              class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-colors"
              placeholder="Enter article description (max 250 characters)"></textarea>
          </div>

          <div class="space-y-2">
            <label for="edit-content" class="text-sm font-medium text-gray-600">Content</label>
            <textarea id="edit-content" name="content" required rows="6"
              class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-colors"
              placeholder="Write your article content here"></textarea>
          </div>

          <div class="flex justify-end items-center space-x-4 pt-6 border-t border-gray-100">
            <button type="button" id="cancel-edit-article"
              class="flex items-center px-6 py-2 rounded-full border border-gray-300 text-gray-800 hover:bg-gray-50 transition-colors">
              <i class="fa-solid fa-xmark mr-2"></i>
              Cancel
            </button>
            <button type="submit"
              class="flex items-center bg-orange-500 text-white px-8 py-2 rounded-full hover:bg-orange-600 transform hover:-translate-y-0.5 transition-all duration-200">
              <i class="fa-solid fa-pen-to-square mr-2"></i>
              Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script src="dashboard.js"></script>
</body>

</html>