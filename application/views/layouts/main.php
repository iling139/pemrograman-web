<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= isset($title) ? $title : 'Dashboard' ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 text-gray-900">

  <!-- Wrapper -->
  <div class="flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <?php $this->load->view('layouts/sidebar'); ?>

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
      <?php $this->load->view($content); ?>
    </div>

  </div>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>
