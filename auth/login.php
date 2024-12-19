<?php
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['role'])) {
  $connected = true;
  $first_name = $_SESSION['first_name'];
  $last_name = $_SESSION['last_name'];
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

  <title>BlogSphere - LogIn</title>
</head>

<body>
  <header class="bg-[#ffe5cf] py-4 h-[10vh]">
    <div class="container mx-auto flex justify-between items-center">
      <div class="logo">
        <img src="../assets/sphereblog.png" alt="Logo" class="w-28">
      </div>
      <nav class="nav px-2">
        <ul class="flex">
          <li><a href="../index.php" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Home</a></li>
          <li><a href="../articles/articles.php" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Articles</a>
          </li>
          <li><a href="login.php" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Authentification</a></li>
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