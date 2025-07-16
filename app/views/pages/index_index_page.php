<header>
    <h1>ГОЛОВНА СТОРІНКА</h1>
</header>
<main>
    <div class="left-block">
        <a href="/">
            <img src="images/logo.png" alt="Логотип школи" class="logo">
        </a>
    </div>
    <div class="form-block">
        <form method="get" action="/index/registerPage/">
            <button class="register-btn">Реєстрація</button>
        </form>
        <form method="post" action="/auth/login">
            <h2>Вхід</h2>
            <label>
                Логін: <br>
                <input type="text" name="login">
            </label><br>
            <label>
                Пароль: <br>
                <input type="password" name="password">
            </label><br><br>
            <button type="submit">Підтвердити</button>
            <button type="reset">Відмінити</button>
        </form>
    </div>
</main>
<footer>
    <p>Наша школа пропонує сучасне навчання програмуванню, веб-технологіям і проєктному мисленню. Запрошуємо!</p>
</footer>