<?php
require '../config_db.php';
session_start();

if (isset($_GET['id'])) {
  $article_id = intval($_GET['id']);
  $query = "SELECT * FROM articles WHERE id = $article_id";
  $result = mysqli_query($conn, $query);
  if ($result) {
    $article = mysqli_fetch_assoc($result);

    $query = "SELECT tags.name
            FROM tags
            JOIN article_tag ON tags.id = article_tag.tag_id
            JOIN articles ON article_tag.article_id = articles.id
            WHERE articles.id = $article_id;";

    $result = mysqli_query($conn, $query);
    $tags = mysqli_fetch_all($result, MYSQLI_ASSOC);
    var_dump($tags);

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
  <title>Document</title>

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

  <section class="py-20 bg-white min-h-[75vh] w-[85%] mx-auto">

    <div class="container mx-auto px-6">
      <div class="flex flex-col items-center text-center mb-10">
        <img src="../uploads/<?= htmlspecialchars($article['image']); ?>" alt="Article Image"
          class="w-full max-w-3xl h-auto object-contain rounded-lg shadow-lg mb-6">

        <h1 class="text-4xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($article['title']); ?></h1>

        <p class="text-xl text-gray-600 mb-6"><?= htmlspecialchars($article['description']); ?></p>

        <div class="text-sm text-gray-500 mb-4">
          <span>Published on: <strong><?= date('m/d/Y', strtotime($article['publish_date'])); ?></strong></span> |
          <span>By: <strong><?= htmlspecialchars($article['user_id']); ?></strong></span>
        </div>

        <div class="flex flex-wrap gap-2 mb-6 min-h-3">
          <?php foreach ($tags as $tag) { ?>
            <span
              class="bg-blue-200 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full"><?= htmlspecialchars($tag['name']); ?></span>
          <?php } ?>
        </div>
      </div>

      <div class="prose prose-lg text-gray-700 max-w-none">
        <p><?= nl2br(htmlspecialchars($article['content'])); ?></p>
      </div>
    </div>
    </div>

  </section>

  <section class="pb-20 pt-10 bg-white min-h-[75vh] w-[85%] mx-auto">
    <div class="container mx-auto px-6">
      <!-- Comments Section -->
      <div class="mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Comments</h2>

        <!-- Existing Comments -->
        <div class="space-y-6">
          <div class="bg-gray-100 p-4 rounded-lg shadow-md">
            <p class="text-sm text-gray-600"><strong>John Doe</strong> - <span class="text-gray-400">12/12/2024</span>
            </p>
            <p class="text-gray-800 mt-2">This is a comment about the article. Very informative and well-written!</p>
          </div>

          <div class="bg-gray-100 p-4 rounded-lg shadow-md">
            <p class="text-sm text-gray-600"><strong>Jane Smith</strong> - <span class="text-gray-400">12/13/2024</span>
            </p>
            <p class="text-gray-800 mt-2">I learned a lot from this article. Keep up the great work!</p>
          </div>
        </div>
      </div>

      <!-- Comment Form -->
      <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <?php
        if ($connected) {
          ?>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">Leave a Comment</h3>
          <form action="submit_comment.php" method="POST">
            <div class="mb-4">
              <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
              <input type="text" id="comment" name="comment" required
                class="w-full border border-gray-300 rounded px-4 py-2 mt-2 focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="Write your comment here">
            </div>

            <button type="submit"
              class="w-52 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:ring focus:ring-blue-300 transition">Submit
              Comment</button>
          </form>

          <?php
        } else {
          ?>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            You need to <a href="../auth/login.php" class="text-blue-600 hover:text-blue-700">login</a> to leave a
            comment.</h3>
          <a href="../auth/login.php"><button
              class="w-44 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:ring focus:ring-blue-300 transition">
              Login</button>
          </a>
          <?php
        }
        ?>

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