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
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link rel="stylesheet" href="../styles.css">

  <title>BlogSphere - LogIn</title>
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
          <li><a href="../articles/articles.php" class="text-gray-800 hover:bg-[var(--buff)] py-2 px-4 rounded">Articles</a></li>
          <?php
          if (!$connected) {
            echo '<li><a href="login.php" class="text-white bg-black hover:bg-black/70 py-2 px-4 rounded-full">
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
                <li><a href="handel_auth/logout.php" class="block px-4 py-2 hover:bg-gray-600 rounded-b">Logout</a></li>
              </ul>
            </li>
            <?php
          }
          ?>

        </ul>
      </nav>
    </div>
  </header>

  <section class="h-[75vh] flex flex-col justify-center mx-auto w-[50%]">
    <?php
    if ($connected) {
      ?>
      <h2 class="text-center text-3xl font-semibold text-gray-900">You are already loged in
        <?= "$first_name $last_name" ?>
      </h2>
      <a href="../../index.php" class="mx-auto">
        <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
          Go Home</button>
      </a>
      <?php
    } else {
      ?>
      <div class="text-center mb-4">
        <h2 class="text-xl font-semibold text-gray-900">Login to Your Account</h2>
        <p class="text-gray-600 mt-2">Don't have an account? <a href="register.php"
            class="text-blue-600 hover:underline">Register here</a></p>
      </div>
      <div class="text-center mb-4 min-h-5">
        <?php if (isset($_SESSION['login_error'])) { ?>
          <p class="text-red-500 text-sm font-semibold"><?= $_SESSION['login_error'] ?></p>
          <?php unset($_SESSION['login_error']);
        } ?>
      </div>
      <form action="handel_auth/login_process.php" method="POST" class="mx-auto w-2/3">
        <div class="mb-5">
          <label for="email" class="block mb-2 font-bold text-gray-900">Your email</label>
          <input type="email" name="email"
            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Example@email.com" required />
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 font-bold text-gray-900">Your password</label>
          <input type="password" name="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required />
        </div>
        <button type="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center">Login</button>
      </form>
      <?php
    }
    ?>
  </section>


  <footer class="bg-[#ffe5cf] py-4 px-2 h-[15vh]">
    <div class="container mx-auto flex justify-between items-center">
      <div class="logo">
        <img src="../assets/sphereblog.png" alt="Logo" class="w-24">
      </div>

      <nav>
        <ul class="flex space-x-8">
          <li><a href="../index.php" class="text-gray-800 hover:text-[#e8b28b]">Home</a></li>
          <li><a href="../articles/articles.php" class="text-gray-800 hover:text-[#e8b28b]">Articles</a></li>
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