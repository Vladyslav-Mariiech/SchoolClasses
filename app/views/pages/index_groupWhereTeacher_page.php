<!DOCTYPE html>
<html lang="uk">
<head>
	<meta charset="UTF-8">
	<title>Група — Вчитель</title>
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
            padding: 40px;
            display: flex;
            justify-content: center;
        }
        .form-block {
            width: 100%;
            max-width: 900px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }
        .form-block h2 {
            margin-top: 0;
        }
        .top-right {
            position: absolute;
            top: 30px;
            right: 30px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f9f9f9;
        }
        .download-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
        .create-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .create-btn:hover {
            background-color: #218838;
        }
        select, input[type="date"] {
            padding: 6px 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        footer {
            text-align: center;
            background-color: #ddd;
            padding: 20px;
        }
        .download-section {
            position: relative;
        }

        .file-select {
            display: none;
            margin-top: 10px;
        }

        .toggle-checkbox {
            display: none;
        }

        .toggle-checkbox:checked + label + .file-select {
            display: block;
        }
	</style>
</head>
<body>

<header>
	<h1>НАЗВА ГРУПИ, ДЕ КОРИСТУВАЧ ВЧИТЕЛЬ</h1>
</header>

<main>
	<div class="form-block">
		<div class="top-right">Привіт, <?=$login?>!</div>
		<h2>Домашнє завдання</h2>
		<table>
			<thead>
			<tr>
				<th>Учні</th>
				<th>Кінцева дата здачі</th>
				<th>Статус</th>
				<th>Оцінка</th>
				<th>Файл</th>
			</tr>
			</thead>
			<tbody>
            <?php foreach ($assignments as $row): ?>
				<tr>
					<td><?= $row['user_login'] ?></td>
					<td><?= date('Y-m-d', strtotime($row['due_date'])) ?></td>
					<td><?= $row['submission_status'] === 'Passed' ? 'Здав' : 'Не здав' ?></td>
					<td>
						<label>
							<select name="grade[<?= $row['assignment_id'] ?>][<?= $row['user_id'] ?>]">
								<option value="" disabled <?= $row['grade'] === null ? 'selected' : '' ?>>Оцінка</option>
                                <?php foreach ([1, 2, 3, 4, 5] as $grade): ?>
									<option value="<?= $grade ?>" <?= $row['grade'] == $grade ? 'selected' : '' ?>>
                                        <?= $grade ?>
									</option>
                                <?php endforeach; ?>
							</select>
						</label>
					</td>
					<td>
                        <?php if (!empty($row['submission_file'])): ?>
							<a class="download-btn" href="/uploads/<?= urlencode($row['submission_file']) ?>" download>Завантажити</a>
                        <?php else: ?>
							Немає файлу
                        <?php endif; ?>
					</td>
				</tr>
            <?php endforeach; ?>
			</tbody>
		</table>
		<button class="create-btn" onclick="location.href='index_createHomeWork_page.php'">Створити Домашнє завдання</button>
	</div>
</main>
<footer>
	<p>Наша школа пропонує сучасне навчання програмуванню, веб-технологіям і проєктному мисленню. Запрошуємо!</p>
</footer>

</body>
</html>
