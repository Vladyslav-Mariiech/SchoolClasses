<header>
    <h1>МОЇ ГРУПИ</h1>
</header>
<main class="centered-main">
	<form id="logout-form" method="post" action="/auth/logout" style="display: none;"></form>
    <div class="group-invite-popup popup hide">
        <div class="invite-close-btn close-btn">Х</div>
        <div class="invite-section">
            <h3 class="invite-section-title">Запросити до групи</h3>
            <div class="invite-section-groups">
            </div>
        </div>
    </div>
    <div class="invite-link-popup popup hide">
        <div class="link-close-btn close-btn">Х</div>
        <h3 class="invite-link-title">Скопіюйте посилання для запрошення в групу</h3>
        <div class="invite-link-popup-content"></div>
    </div>
	<p style="text-align: right;">
		<a href="/" id="logout-link" style="color: black;
		text-decoration: none; margin-left: 20px;
		   position: relative;
		    left: 90%; font-size: 20px;
		     z-index: 1; font-weight: bold"
		>Выйти</a>
	</p>
    <div class="form-block">
		<p style="text-align: right;"><strong>Привіт, <?= $login ?>!</strong></p>
        <form>
            <h2>Групи вчитель</h2>
            <table id="teacher-group">
                <tbody>
                    <?php foreach ($ownedClasses as $class): ?>
                        <tr>
							<td><a href="/assignments/index?class_id=<?= $class['class_id'] ?>">
                                    <?=$class['name']?>
								</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="button" class="group-invite-btn">Запросити до групи</button>
            <button type="button" class="group-create-btn">Створити групу</button>
        </form>
        <div class="form-block form-group-create hide">
            <form id="group-create-form">
				<div id="group-create-message" style="margin-top: 10px; font-weight: bold;"></div>
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
                        </tr>
						<td><a href="/submission/all?class_id=<?= $class['class_id'] ?>">
                                <?=$class['name']?>
							</a></td>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
</main>

<?php if (!empty($success)): ?>
	<div id="success-message">
        <?= $success ?>
	</div>
<?php endif; ?>
<div id="popup-success-message">
</div>
<script src="/js/class.js"></script>
