<?php $this->layout('master', ['title' => $title]) ?>

<h1>User</h1>

<form action="/user/update/12" method="post">
    <input type="text" name="firstName" value="Lucas">
    <input type="text" name="lastName" value="Moraes">
    <input type="mail" name="email" value="lucasmoraes@email.com">
    <input type="password" name="password" value="123456">

    <button type="submit">Atualizar</button>
</form>