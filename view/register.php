<?php

use Dotenv\Dotenv;

include './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>style.css">
    <meta name="color-scheme" content="dark light">
</head>

<body class="dark:bg-slate-800 dark:text-white h-screen flex flex-col">
    <?php include_once 'components/header.php'; ?>
    <main class="px-4 flex-grow">
        <div class="max-w-md mx-auto p-4 rounded-lg shadow-lg">
            <div class="py-5">
                <h1 class="text-3xl">Register</h1>
            </div>
            <div>
                <form action="<?= BASE_URL?>api/register" method="post">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="off"/>
                        <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="password_repeat" id="floating_password_repeat" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        <label for="floating_password_repeat" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm Password</label>
                    </div>
<?php
if(!empty($_GET['empty_fields'])){
    ?> <div class="text-red-500 font-bold pb-4">All fields are required!</div> <?php
}else if (!empty($_GET['username'])){
    ?> <div class="text-red-500 font-bold pb-4">Provide a valid username: only letters, numbers, and dashes are allowed</div> <?php
}else if (!empty($_GET['password'])){
    ?> <div class="text-red-500 font-bold pb-4">Password must be at least 8 characters long and contain at least one number.</div> <?php
}else if (!empty($_GET['pwd_mismatch'])){
    ?> <div class="text-red-500 font-bold pb-4">Passwords do not match.</div> <?php
}else if (!empty($_GET['user_exists'])){
    ?> <div class="text-red-500 font-bold pb-4">User already exists!</div> <?php
}


?>
                    <div class="flex items-center gap-4">
                        <div>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</button>
                        </div>
                        <div>
                            <a href="login" class="dark:text-white  text-sm hover:underline">Already have an account? Login instead</a>
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </main>
    <?php include_once 'components/footer.php'; ?>
</body>

</html>