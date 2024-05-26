<?php 
$link =  $authenticated  ?  '<a href="logout">Logout</a>' : '<a href="login">Login</a>'; 
?>
<header class="flex justify-between p-4">
    <div>
        <a href="<?php BASE_URL ?>home"><h1 class="text-3xl font-bold">Launch tracker</h1></a>
    </div>
    <nav>
        <ul class="flex gap-3">
            <li><a href="about">About</a></li>
            <li><?= $link ?></li>
            <li><a href="dashboard">Dashboard</a></li>
        </ul>
    </nav>
  </header>
