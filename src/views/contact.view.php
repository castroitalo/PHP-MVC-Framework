<h1><?= $title; ?></h1>

<form action="/contact" method="POST">
    <div class="input">
        <label for="subject">Subject</label>
        <input type="Text" name="subject" id="subject">
    </div>
    <div class="input">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" id="user_email">
    </div>
    <div class="input">
        <label for="user_password">Body</label>
        <textarea name="body" id="body"></textarea>
    </div>

    <button type="submit">Submit</button>
</form>
