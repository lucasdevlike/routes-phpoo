<?php $this->layout('master', ['title' => $title]) ?>

<h1>Contato</h1>

<form action="/contact" method="post">

    <input type="text" name="email" id="" placeholder="email"><br>
    <input type="text" name="subject" id="" placeholder="assunto"><br>
    <textarea name="message" id="" cols="30" rows="10" placeholder="Mensagem"></textarea><br>

    <button type="submit">Send Mail</button>

</form>