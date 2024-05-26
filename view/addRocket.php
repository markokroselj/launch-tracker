<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>style.css">
    <title>Launch tracker - add rocket</title>
    <meta name="color-scheme" content="dark light">
    <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
</head>

<body class="dark:bg-slate-800 dark:text-white h-screen flex flex-col">

    <?php include_once 'components/header.php';
    ?>
    <main class="px-4 flex-grow">
        <h1>Add a rocket 🚀</h1>
        <div class="py-4 my-2">

            <form class="max-w-sm">
                <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Launch provider</label>
                <select id="small" name="lsp" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a launch provider</option>
                    <?php foreach ($lsps as $lsp) : ?>
                        <option value="<?= $lsp["LSP_ID"] ?>"><?= $lsp["Name"] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name" />
                </div>
                <div class="mb-5">
                    <label for="maidenFlightDate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maiden flight date</label>
                    <input type="date" name="maidenFlightDate" id="maidenFlightDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Maiden flight date" />
                </div>
                <div class="mb-5">
                    <label for="number-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Length</label>
                    <input type="number" name="length" id="number-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />

                </div>
                <div class="flex items-center mb-4">
                    <input id="reusable" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="reusable" name="reusable" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Reusable</label>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
            </form>

            <div id="result"></div>
        </div>
    </main>
    <?php include_once 'components/footer.php'; ?>

</body>

</html>