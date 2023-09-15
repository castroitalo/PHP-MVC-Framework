<h1><?= $title; ?></h1>

<form action="/register" method="POST">
    <div class="input">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" id="user_email">
    </div>
    <div class="input">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" id="user_password">
    </div>

    <button type="submit">Submit</button>
</form>
