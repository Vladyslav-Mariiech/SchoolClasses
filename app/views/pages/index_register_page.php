<header>
    <h1>РЕЄСТРАЦІЯ</h1>
</header>
<main>
    <div class="form-block">
        <form method="post" action="/auth/register">
            <label>
                Email: <br>
                <input type="email" name="email">
            </label><br>
            <label>
                Логін: <br>
                <input type="text" name="login">
            </label><br>
            <label>
                Пароль: <br>
                <input type="password" name="password">
            </label><br>
            <label>
                Підтвердіть пароль: <br>
                <input type="password" name="confirm">
            </label><br><br>
            <button type="submit">Підтвердити</button>
            <button type="button" onclick="location.href='/'">Відмінити</button>
        </form>
    </div>
</main>