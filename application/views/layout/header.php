<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title : 'Kantin Digital'; ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <!-- Navbar -->
  <nav class="bg-green-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-lg font-bold">Kantin Digital</h1>
    <div class="space-x-3">
      <span class="font-medium"><?= $this->session->userdata('nama_lengkap'); ?> (<?= ucfirst($this->session->userdata('role')); ?>)</span>
      <a href="<?= site_url('auth/logout'); ?>" class="bg-red-500 hover:bg-red-700 px-3 py-1 rounded">Logout</a>
    </div>
  </nav>

  <div class="container mx-auto p-6">
