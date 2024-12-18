<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>BlogSphere - Register</title>
</head>

<body>
  <header class="bg-[#ffe5cf] py-4 h-[10vh]">
    <div class="container mx-auto flex justify-between items-center">
      <div class="logo">
        <img src="your-logo.png" alt="Logo" class="w-10">
      </div>
      <nav class="nav">
        <ul class="flex">
          <li><a href="../index.php" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Home</a></li>
          <li><a href="#" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">About</a></li>
          <li><a href="#" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Contact</a></li>
          <li><a href="#" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Authentification</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="h-[75vh] flex flex-col justify-center mx-auto w-[50%]">
    <div class="text-center mb-4">
      <h2 class="text-xl font-semibold text-gray-900">Create Your Account</h2>
      <p class="text-gray-600 mt-2">Already have an account? <a href="login.php"
          class="text-blue-600 hover:underline">Login here</a></p>
    </div>
    <form action="handel_forms/register_process.php" method="POST" class="mx-auto w-2/3">
      <div class="mb-5">
        <label for="email" class="block mb-2 font-bold text-gray-900">Your email</label>
        <input type="email" name="email" id="email"
          class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
          placeholder="Example@email.com" required />
      </div>
      <div class="flex gap-4 mb-5">
        <div class="w-1/2">
          <label for="first_name" class="block mb-2 font-bold text-gray-900">First name</label>
          <input type="text" name="first_name" id="first_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
            placeholder="First name" required />
        </div>
        <div class="w-1/2">
          <label for="last_name" class="block mb-2 font-bold text-gray-900">Last name</label>
          <input type="text" name="last_name" id="last_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
            placeholder="Last name" required />
        </div>
      </div>
      <div class="mb-5">
        <label for="password" class="block mb-2 font-bold text-gray-900">Your password</label>
        <input type="password" name="password" id="password"
          class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
          required />
      </div>
      <div class="mb-5">
        <label for="confirm_password" class="block mb-2 font-bold text-gray-900">Confirm your password</label>
        <input type="password" name="confirm_password" id="confirm_password"
          class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
          required />
      </div>
      <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-6 py-2 text-center">Register</button>
    </form>
  </section>




  <footer class="bg-[#ffe5cf] py-4 px-2 h-[15vh]">
    <div class="container mx-auto flex justify-between items-center">
      <div class="logo">
        <img src="your-logo.png" alt="Logo" class="w-10">
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