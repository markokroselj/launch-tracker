<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>style.css">
    <meta name="color-scheme" content="dark light">
</head>
<body class="dark:bg-black dark:text-white h-screen flex flex-col gap-6 items-center justify-center">
    <div class="flex items-center">
        <div class="border-r px-5 border-gray-500">
            <h1 class="font-bold text-3xl">404</h1> 
        </div>
        <div class="px-5">
            <p>This page could not be found.</p>
        </div>
    </div>
    <div>
        <a href="<?= BASE_URL ?>" class="px-6 py-2 bg-slate-800 text-white dark:bg-white dark:text-black rounded">Home</a>
    </div>
</body>
</html>
