<!DOCTYPE html>
<html>
<head>
  <title>Login Kantin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

  <div class="bg-white shadow-lg rounded-lg p-6 w-96">
    <h2 class="text-2xl font-bold text-center mb-4">Login Kantin</h2>

    <?php if($this->session->flashdata('error')): ?>
      <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
        <?= $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('auth/login'); ?>">
      <div class="mb-4">
        <label class="block font-medium">Username</label>
        <input type="text" name="username" required class="w-full border p-2 rounded">
      </div>

      <div class="mb-4">
        <label class="block font-medium">Password</label>
        <input type="password" name="password" required class="w-full border p-2 rounded">
      </div>

      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">Login</button>
    </form>
  </div>

</body>
</html>
