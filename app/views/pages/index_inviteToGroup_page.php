<header>
	<h1>Вітаємо !</h1>
    <?php if(!empty($error)):?><div class="errors"><?=$error?></div><?php endif;?>
</header>
<main>
	<div class="box">
        <?php if ($classId !== null): ?>
			<div class="agree-or-no-in-group">
				<h2>Запрошення до групи <i><?=$className?></i></h2>
				<a href="/class/join/?id=<?=$classId; ?>">Прийняти запрошення в групу</a>
				<a href="/class/index">Отклонить</a>
			</div>
        <?php endif; ?>
	</div>
</main>




