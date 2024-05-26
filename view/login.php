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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <meta name="color-scheme" content="dark light">
</head>
<body class="dark:bg-slate-800 dark:text-white h-screen flex flex-col">
  <?php include_once 'components/header.php'; ?>
  <main class="px-4 flex-grow">
    <div class="max-w-md mx-auto p-4 rounded-lg shadow-lg">
        <div class="py-5">
          <?php if(isset($register_status_output) && !empty($register_status_output)){
            ?>
            <div class="text-green-500 py-1">
            <strong><?=$register_status_output?></strong>
            </div>
            <?php
          }?>
          <?php
if(!empty($_GET['empty_fields'])){
    ?> <div class="text-red-500 font-bold pb-4">All fields are required!</div> <?php
}else if (!empty($_GET['username'])){
    ?> <div class="text-red-500 font-bold pb-4">Provide a valid username: only letters, numbers, and dashes are allowed</div> <?php
}else if (!empty($_GET['invalid_credentials'])){
    ?> <div class="text-red-500 font-bold pb-4">Invalid username or password!</div> <?php
}
?>
        <h1 class="text-3xl">Login</h1>
        </div>
        <div>      
          <?php 
          $after_login = "";
          $state="";
          if(isset($_GET['after-login']) && !empty($_GET['after-login'])){
            $after_login = "?".http_build_query(["after-login" => $_GET['after-login']]);
            $state = http_build_query(["state" => $_GET['after-login']]);
          }
          ?>
<form action="<?= BASE_URL?>api/login<?=$after_login?>" method="post">
  <div class="relative z-0 w-full mb-5 group">
      <input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  autocomplete="off"/>
      <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
  </div>
  <div class="relative z-0 w-full mb-5 group">
      <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
      <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
  </div>
<div class="flex align-middle gap-4">
 <div>
 <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
 </div>
 <div>
 <a href="https://github.com/login/oauth/authorize?client_id=<?= $_ENV['GITHUB_CLIENT_ID'] ?>&scope=user:read&<?= $state ?>" class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 me-2 mb-2">
<svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
<path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
</svg>
Sign in with Github
</a>
 </div>
</div>
<div class="py-1">
  <a href="register" class="dark:text-white  text-sm hover:underline">New? Register an account</a>
 </div>
</form>

        </div>
    </div>
  </main>
  <?php include_once 'components/footer.php'; ?>
</body>
</html>