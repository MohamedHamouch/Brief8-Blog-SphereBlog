<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlogSphere - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

  <header class="bg-[#ffe5cf] py-4 h-[10vh]">
    <div class="container mx-auto flex justify-between items-center">
      <div class="logo">
        <img src="your-logo.png" alt="Logo" class="w-10">
      </div>
      <nav class="nav">
        <ul class="flex">
          <li><a href="#" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Home</a></li>
          <li><a href="#" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">About</a></li>
          <li><a href="#" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Contact</a></li>
          <li><a href="auth/login.php" class="text-gray-800 hover:bg-[#e8b28b] py-2 px-4 rounded">Authentification</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="bg-[#ffe5cf] py-20 text-center">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-gray-800 mb-4">Welcome to Our Platform</h2>
      <p class="text-lg text-gray-600 mb-8">A place for sharing ideas and connecting with others.</p>
      <a href="#" class="bg-[#f1c6a1] text-gray-800 py-2 px-6 rounded hover:bg-[#e8b28b] transition duration-300">Get
        Started</a>
    </div>
  </section>

  <section class="py-20 bg-white">
    <div class="container mx-auto text-center">
      <h2 class="text-2xl font-bold text-gray-800 mb-8">Our Latest Articles</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Article Card 1 -->
        <div class="bg-gray-100 p-6 rounded shadow-md hover:shadow-lg transition duration-300 max-w-xs mx-auto">
          <h3 class="text-xl font-semibold text-gray-800 mb-4">Article Title 1</h3>
          <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <a href="#" class="text-[#e8b28b] hover:text-[#f1c6a1] font-bold">Read More</a>
        </div>
        <!-- Article Card 2 -->
        <div class="bg-gray-100 p-6 rounded shadow-md hover:shadow-lg transition duration-300 max-w-xs mx-auto">
          <h3 class="text-xl font-semibold text-gray-800 mb-4">Article Title 2</h3>
          <p class="text-gray-600 mb-4">Vivamus lacinia, purus eu vehicula lacinia.</p>
          <a href="#" class="text-[#e8b28b] hover:text-[#f1c6a1] font-bold">Read More</a>
        </div>
        <!-- Article Card 3 -->
        <div class="bg-gray-100 p-6 rounded shadow-md hover:shadow-lg transition duration-300 max-w-xs mx-auto">
          <h3 class="text-xl font-semibold text-gray-800 mb-4">Article Title 3</h3>
          <p class="text-gray-600 mb-4">Curabitur nec nisi et arcu feugiat posuere.</p>
          <a href="#" class="text-[#e8b28b] hover:text-[#f1c6a1] font-bold">Read More</a>
        </div>
      </div>
    </div>
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