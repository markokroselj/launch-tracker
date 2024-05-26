<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Launch tracker - dashboard</title>
  <meta name="color-scheme" content="dark light">
</head>
<body class="dark:bg-slate-800 dark:text-white h-screen flex flex-col">

  <?php include_once 'components/header.php'; 
   ?>
  <main class="px-4 flex-grow">
    <h1 class="text-xl py-2">Hi <?=$username?> 👋</h1>
    <p class="py-1">Here you can add a new rocket launch 🚀 and manage the data about orbits, launch service providers, launch pads and rockets.</p>
    <div class="p-4 my-4 dark:bg-slate-600 rounded shadow-lg w-fit">
        <nav>
        <ul class="flex gap-4">
            <li><a href="add/orbit" class="hover:underline">Add orbit</a></li>
            <li><a href="add/lsp" class="hover:underline">Add launch service provider</a></li>
            <li><a href="add/lc" class="hover:underline">Add launch complex</a></li>
            <li><a href="add/rocket" class="hover:underline">Add rocket</a></li>
        </ul>
        </nav>
    </div>
    <div>
        <a href="add/new"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >Add a new launch</a>
    </div>
  </main>
  <?php include_once 'components/footer.php'; ?>
</body>
</html>