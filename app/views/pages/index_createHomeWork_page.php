<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Створення домашнього завдання</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        main {
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
        }

        .form-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-group label {
            width: 40%;
            font-weight: bold;
        }

        .form-group input[type="date"],
        .form-group select {
            width: 55%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .ok-btn {
            background-color: #28a745;
            color: white;
        }

        .ok-btn:hover {
            background-color: #218838;
        }

        .cancel-btn {
            background-color: #dc3545;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }

        footer {
            text-align: center;
            background-color: #ddd;
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Створення домашнього завдання</h1>
</header>

<main>
    <form class="form-container" method="POST" action="/assignments/store" enctype="multipart/form-data">
		<input type="hidden" name="class_id" value="<?= $classId ?>">
		<?php if(!empty($errors)):?>
			<div class="errors"><?=$errors?></div>
		<?php endif;?>
        <div class="form-group">
            <label for="deadline">Дедлайн</label>
            <input type="date" id="deadline" name="deadline" required>
        </div>
		<div class="form-group">
            <label for="file">Прикріпити файл</label>
			<input type="file" name="file">
        </div>

        <div class="buttons">
            <button type="submit" class="ok-btn">ОК</button>
            <button type="button" onclick="location.href='/assignments/index?class_id=<?=$classId?>'">Відмінити</button>
        </div>
    </form>
</main>
</body>
</html>
