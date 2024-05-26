<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Launch tracker</title>
  <meta name="color-scheme" content="dark light">
</head>

<body class="dark:bg-slate-800 dark:text-white h-screen flex flex-col">

  <?php include_once 'components/header.php'; 
   ?>
  <main class="px-4 flex-grow">
    <div>
      <h1 class="text-xl py-3">Rocket launch tracker 🚀</h1>
      <p>Database of orbital launches that happend around the world</p>
    </div>
    <div class="py-5">
      <h2 class="py-2">The latest launch:</h2>
      <div class="bg-slate-900 shadow-lg w-fit rounded-lg p-4">
        <div>
          <h3>Falcon 9 Block 5</h3>
        </div>
        <div>
          <p>Starlink Group 6-62</p>
        </div>
        <div>
          <p>SpaceX</p>
        </div>
        <div>
          <p>Cape Canaveral, FL, USA</p>
        </div>
        <div>
          <p>May 23, 2024 - 04:35:00 CEST</p>
        </div>
      </div>
    </div>
    <div>
      <a href="launches" class="dark:bg-white dark:text-black px-2 py-2 my-2 block w-fit rounded-sm">All launches</a>

    </div>
  </main>
  <?php include_once 'components/footer.php'; ?>
</body>

</html>