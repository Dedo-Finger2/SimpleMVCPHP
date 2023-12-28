<title><?= $title ?></title>
<h1>Home Page</h1>

<ul>
    <?php foreach($users as $user) { ?>
        <li><?= $user->name ?></li>
        <li><?= $user->email ?></li>
    <?php } ?>
</ul>
