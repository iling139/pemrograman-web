<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center">

  <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-sm">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Login</h2>

    <?php if($this->session->flashdata('error')): ?>
      <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded mb-4">
        <?= $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('auth/login'); ?>" class="space-y-5">
      <!-- Username -->
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <div class="flex items-center border border-gray-300 rounded-md shadow-sm focus-within:ring-2 focus-within:ring-blue-400">
          <span class="px-3 text-gray-500">
            <i data-lucide="user" class="w-5 h-5"></i>
          </span>
          <input type="text" name="username" id="username" required
                 class="w-full px-2 py-2 outline-none text-sm rounded-r-md"
                 placeholder="Masukkan username">
        </div>
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <div class="flex items-center border border-gray-300 rounded-md shadow-sm focus-within:ring-2 focus-within:ring-blue-400">
          <span class="px-3 text-gray-500">
            <i data-lucide="lock" class="w-5 h-5"></i>
          </span>
          <input type="password" name="password" id="password" required
                 class="w-full px-2 py-2 outline-none text-sm rounded-r-md"
                 placeholder="••••••••">
        </div>
      </div>

      <!-- Tombol -->
      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md shadow transition duration-200">
        Masuk
      </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
      &copy; <?= date('Y') ?> Kantin Digital
    </p>
  </div>

  <script>
    lucide.createIcons();
  </script>

</body>
</html>
