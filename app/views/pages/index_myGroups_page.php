<header>
    <h1>МОЇ ГРУПИ</h1>
</header>
<main class="centered-main">
    <div class="form-block">
        <p style="text-align: right;"><strong>Привіт, логін!</strong></p>
        <form>
            <h2>Групи вчитель</h2>
            <ul>
                <?php foreach ($ownedClasses as $class): ?>
                    <li><a href="#"><?= $class['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="group-invite" onclick="location.href='index_inviteToGroup_page.php'">Запросити до групи</button>
            <button type="button" class="group-create" onclick="location.href='/class/create'">Створити групу</button>
        </form>
        <br><br>
        <form>
            <h2>Групи учень</h2>
            <ul>
                <?php foreach ($memberClasses as $class): ?>
                    <li><a href="#"><?= $class['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </form>
    </div>
</main>
<footer>
    <p>Наша школа пропонує сучасне навчання програмуванню, веб-технологіям і проєктному мисленню. Запрошуємо!</p>
</footer>