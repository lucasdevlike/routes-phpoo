<?php $this->layout('master', ['title' => $title]) ?>

<h1>User</h1>

<?php echo flash('created');?>
<form action="/user/update" method="post">
    <?php echo flash('firstName');?>
    <input type="text" name="firstName" value="Lucas">
    <?php echo flash('lastName');?>
    <input type="text" name="lastName" value="Moraes">
    <?php echo getToken(); ?>
    <?php echo flash('email');?>
    <input type="mail" name="email" value="lucasmoraes@email.com">
    <?php echo flash('password');?>
    <input type="password" name="password" value="123456">


    <button type="submit">Atualizar</button>
</form>