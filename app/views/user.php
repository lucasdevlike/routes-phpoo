<?php $this->layout('master', ['title' => $title]) ?>

<?php $this->start('css') ?>

<link rel="stylesheet" href="/css/style.css">

<?php $this->stop() ?>

<h1>User</h1>
<p>Hello, <?=$this->e($name)?></p>