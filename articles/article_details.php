<?php
require '../config_db.php';
session_start();

if (isset($_GET['article'])) {
  $article_id = $_GET['article'];
  $stmt = mysqli_prepare($conn, "SELECT * FROM articles WHERE id = ?");
  mysqli_stmt_bind_param($stmt, 'i', $article_id); 
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($result) {
    $article = mysqli_fetch_assoc($result);
    if (!$article) {
      $found = false;
    } else {
      $found = true;
      $stmt_tags = mysqli_prepare(
        $conn,
        "SELECT tags.name 
             FROM tags 
             JOIN article_tag ON tags.id = article_tag.tag_id 
             WHERE article_tag.article_id = ?"
      );
      mysqli_stmt_bind_param($stmt_tags, 'i', $article_id);
      mysqli_stmt_execute($stmt_tags);
      $result_tags = mysqli_stmt_get_result($stmt_tags);
      $tags = mysqli_fetch_all($result_tags, MYSQLI_ASSOC);
    }
  } else {
    header('Location: ../index.php');
    exit();
  }

  if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $role = ($_SESSION['role'] == 2) ? 'user' : 'admin';
    $connected = true;
  } else {
    $connected = false;
  }
} else {
  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlogSphere - <?= $found ? htmlspecialchars($article['title']) : 'Article Not Found' ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
  <!-- Navbar -->
  <header class="bg-white shadow-sm fixed w-full z-50">
    <div class="container mx-auto px-4 py-3">
      <div class="flex justify-between items-center">
        <a href="../index.php" class="flex items-center space-x-2">
          <img src="../assets/sphereblog.png" alt="Logo" class="w-24 h-auto">
        </a>

        <nav class="hidden md:flex items-center space-x-6">
          <a href="../index.php" class="text-gray-600 hover:text-orange-500 transition">Home</a>
          <a href="articles.php" class="text-gray-900 hover:text-orange-500 font-medium transition">Articles</a>
          <?php if (!$connected) { ?>
            <a href="../auth/login.php"
              class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition">
              <i class="fa-solid fa-user-plus mr-2"></i>Sign In
            </a>
          <?php } else { ?>
            <div class="relative group">
              <button
                class="flex items-center space-x-2 bg-gray-900 text-white px-6 py-2 rounded-full hover:bg-gray-800 transition">
                <i class="fa-solid fa-user"></i>
                <span><?= "$first_name $last_name" ?></span>
              </button>
              <div
                class="absolute right-0 w-48 mt-2 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform">
                <a href="../profile/profile.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                <?php if ($role === "admin") { ?>
                  <a href="../admin/dashboard.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Admin
                    Dashboard</a>
                <?php } ?>
                <a href="../auth/handel_auth/logout.php" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Logout</a>
              </div>
            </div>
          <?php } ?>
        </nav>

        <!-- Mobile menu button -->
        <button class="md:hidden bg-gray-100 p-2 rounded-lg">
          <i class="fas fa-bars text-gray-600"></i>
        </button>
      </div>
    </div>
  </header>

  <?php if ($found) { ?>
    <!-- Article Hero Section -->
    <section class="pt-24 pb-8 bg-gradient-to-b from-orange-100 to-white">
      <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
          <img src="../uploads/<?= htmlspecialchars($article['image']); ?>" alt="Article Image"
            class="w-full h-[400px] object-cover rounded-xl shadow-lg mb-8">
          <div class="flex flex-wrap gap-2 mb-6">
            <?php foreach ($tags as $tag) { ?>
              <span
                class="bg-orange-100 text-orange-600 text-sm font-medium px-3 py-1 rounded-full"><?= htmlspecialchars($tag['name']); ?></span>
            <?php } ?>
          </div>
          <h1 class="text-4xl font-bold text-gray-900 mb-4"><?= htmlspecialchars($article['title']); ?></h1>
          <p class="text-xl text-gray-600 mb-6"><?= htmlspecialchars($article['description']); ?></p>
          <div class="flex items-center text-sm text-gray-500">
            <span class="mr-4"><i
                class="far fa-calendar mr-2"></i><?= date('F j, Y', strtotime($article['publish_date'])); ?></span>
            <span><i class="far fa-user mr-2"></i>By <?= htmlspecialchars($article['user_id']); ?></span>
          </div>
        </div>
      </div>
    </section>

    <!-- Article Content -->
    <section class="py-12 bg-white">
      <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto prose prose-lg">
          <?= nl2br($article['content']); ?>
        </div>
      </div>
    </section>

    <!-- Comments Section -->
    <section class="py-12 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
          <h2 class="text-3xl font-bold text-gray-900 mb-8">Comments</h2>

          <!-- Existing Comments -->
          <div class="space-y-6 mb-12">
            <div class="bg-white p-6 rounded-xl shadow-sm">
              <div class="flex items-center mb-4">
                <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center">
                  <i class="fas fa-user text-orange-500"></i>
                </div>
                <div class="ml-4">
                  <p class="font-medium text-gray-900">John Doe</p>
                  <p class="text-sm text-gray-500">December 12, 2024</p>
                </div>
              </div>
              <p class="text-gray-600">This is a comment about the article. Very informative and well-written!</p>
            </div>
          </div>

          <!-- Comment Form -->
          <?php if ($connected) { ?>
            <div class="bg-white p-6 rounded-xl shadow-sm">
              <h3 class="text-xl font-bold text-gray-900 mb-6">Leave a Comment</h3>
              <form action="handel_forms/add_comment.php" method="POST">
                <div class="mb-6">
                  <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Comment</label>
                  <input type="text" id="comment" name="comment" required
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    placeholder="Share your thoughts...">
                </div>
                <button type="submit" name="article" value="<?= $article_id ?>"
                  class="bg-orange-500 text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
                  Post Comment
                </button>
              </form>
            </div>
          <?php } else { ?>
            <div class="bg-white p-6 rounded-xl shadow-sm text-center">
              <h3 class="text-xl font-bold text-gray-900 mb-4">Join the Discussion</h3>
              <p class="text-gray-600 mb-6">Sign in to leave a comment on this article.</p>
              <a href="../auth/login.php"
                class="inline-block bg-orange-500 text-white px-8 py-3 rounded-full hover:bg-orange-600 transition">
                Sign In to Comment
              </a>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
  <?php } else { ?>
    <!-- Not Found Section -->
    <section class="pt-32 pb-20 bg-gradient-to-b from-orange-100 to-white">
      <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Article Not Found</h1>
        <p class="text-xl text-gray-600 mb-8">The article you're looking for doesn't exist or has been removed.</p>
        <a href="articles.php"
          class="inline-block bg-orange-500 text-white px-8 py-3 rounded-full hover:bg-orange-600 transition">
          Back to Articles
        </a>
      </div>
    </section>
  <?php } ?>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white mt-auto">
    <div class="container mx-auto px-4 py-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
        <div>
          <img src="../assets/sphereblog.png" alt="Logo" class="w-20 mb-2">
          <p class="text-gray-400 text-sm">Share your stories with the world.</p>
        </div>
        <div class="flex justify-center">
          <ul class="space-y-1 text-center">
            <li><a href="../index.php" class="text-gray-400 hover:text-white transition text-sm">Home</a></li>
            <li><a href="articles.php" class="text-gray-400 hover:text-white transition text-sm">Articles</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition text-sm">Contact</a></li>
          </ul>
        </div>
        <div class="flex flex-col items-end">
          <h3 class="text-sm font-semibold mb-2">Follow Us</h3>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="border-t border-gray-800 mt-4 pt-4 text-center">
        <p class="text-gray-400 text-xs">&copy; 2024 BlogSphere. All rights reserved.</p>
      </div>
    </div>
  </footer>
</body>

</html>