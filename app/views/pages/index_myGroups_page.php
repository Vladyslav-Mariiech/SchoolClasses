<header>
    <h1>МОЇ ГРУПИ</h1>
</header>
<main class="centered-main">
    <div>
        <form method="post" action="/auth/logout">
            <button type="submit">Logout</button>
        </form>
    </div>
    <div class="form-block">
        <p style="text-align: right;"><strong>Привіт, логін!</strong></p>
        <form>
            <h2>Групи вчитель</h2>
            <table id="teacher-group">
                <tbody>
                    <?php foreach ($ownedClasses as $class): ?>
                        <tr>
                            <td><a href="/class/show/?id=<?=$class['link']?>"><?= $class['name'] ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="button" class="group-invite-btn"
                onclick="location.href='index_inviteToGroup_page.php'">Запросити до групи</button>
            <button type="button" class="group-create-btn">Створити
                групу</button>
        </form>
        <div class="form-block form-group-create hide">
            <form id="group-create-form">
                <label>
                    Назва групи: <br>
                    <input type="text" name="name">
                </label><br><br>
                <button type="submit">ОК</button>
                <button type="reset">Відмінити</button>
            </form>
        </div>
        <br><br>
        <form>
            <h2>Групи учень</h2>
            <table id="student-group">
                <tbody>
                    <?php foreach ($memberClasses as $class): ?>
                        <tr>
                            <td><a href="#"><?= $class['name'] ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
</main>
<footer>
    <p>Наша школа пропонує сучасне навчання програмуванню, веб-технологіям і проєктному мисленню. Запрошуємо!</p>
</footer>
<script src="/js/class.js"></script>