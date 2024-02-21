<?php $this->layout('master', ['title' => $title]) ?>

<h1>Home (<?= $pagination->getTotal();?> Usuários cadastrados)</h1>

<ul>
    <?php foreach ($users as $user) : ?>

    <li><?php echo $user->firstName ?></li>

    <?php endforeach; ?>
</ul>

<?php echo $pagination->links(); ?>