<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>style.css">
    <title>Launch tracker - add orbit</title>
    <meta name="color-scheme" content="dark light">
    <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
</head>

<body class="dark:bg-slate-800 dark:text-white h-screen flex flex-col">

    <?php include_once 'components/header.php';
    ?>
    <main class="px-4 flex-grow">
        <h1>Add orbit 🌎</h1>
        <div class="py-4 my-2">
            <form class="max-w-sm" hx-post="<?= BASE_URL ?>api/add-orbit" hx-target="#result" hx-swap="innerHTML">
                <div class="mb-5">
                    <label for="orbitID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Orbit acronym</label>
                    <input type="text" name="id" id="orbitID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Orbit acronym" />
                </div>
                <div class="mb-5">
                    <label for="orbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Orbit</label>
                    <input type="text" name="orbit" id="orbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Orbit" />
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
            </form>
            <div id="result"></div>
        </div>
    </main>
    <?php include_once 'components/footer.php'; ?>

</body>

</html>