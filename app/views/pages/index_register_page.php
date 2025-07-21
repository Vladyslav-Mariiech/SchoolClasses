<header>
	<h1>РЕЄСТРАЦІЯ</h1>
</header>
<main>


	<div class="form-block">
		<form method="post" action="/user/add">
            <?php
            if(isset($errors['common'])): ?>
				<div><?=$errors['common']?></div>
            <?php endif; ?>
            <?php if(isset($errors['email'])): ?>
				<div class="error"><?=$errors['email']?></div>
            <?php endif; ?>
			<label>
				Email: <br>
				<input type="email" name="email"
					   class="<?= isset($errors) ? 'error-input' : ''?>">
			</label>
            <?php if(isset($errors['login'])): ?>
				<div class="error"><?=$errors['login']?></div>
            <?php endif; ?>
			<label>
				Логін:
				<input type="text" name="login"
					   class="<?= isset($errors) ? 'error-input' : ''?>"
			</label>
            <?php if(isset($errors['password'])): ?>
				<div class="error"><?=$errors['password']?></div>
            <?php endif; ?>
			<label>
				Пароль:
				<input type="password" name="password"
					   class="<?= isset($errors) ? 'error-input' : ''?>">
			</label>
            <?php if(isset($errors['passConfirm'])): ?>
				<div class="error"><?=$errors['passConfirm']?></div>
            <?php endif; ?>
			<label>
				Підтвердіть пароль:
				<input type="password" name="passConfirm" class="<?= isset($errors) ? 'error-input' : ''?>">
			</label>

			<button type="submit">Підтвердити</button>
			<button type="button" onclick="location.href='/'">Відмінити</button>
		</form>
	</div>
</main>
