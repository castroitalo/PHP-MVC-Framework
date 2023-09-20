<h1><?= $title; ?></h1>

<?php $form = src\core\form\Form::begin("/register", "POST"); ?>
    <?= $form->field($model, "userEmail")->emailField(); ?>
    <?= $form->field($model, "userPassword")->passwordField(); ?>

    <button type="submit">Submit</button>
<?php src\core\form\Form::end(); ?>
