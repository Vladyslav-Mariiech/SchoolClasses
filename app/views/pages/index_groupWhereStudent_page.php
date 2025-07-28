<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Група студента</title>
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
        select {
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
		.my-groups{
			text-decoration: none;
			color: white;
			position: absolute;
			left: 10px;
		}
    </style>
</head>
<body>

<header>
	<a href="/class/index" class="my-groups">My Groups</a>
    <h1>НАЗВА ГРУПИ - <?=$className['name']?></h1>
</header>

<main>
    <div class="form-block">
        <div class="top-right">Привіт, <?= $login ?>!</div>
        <h2>Перелік домашніх завдань</h2>
        <form method="post" action="/submission/upload" enctype="multipart/form-data">
			<input type="hidden" name="classId" value="<?= $classId?>">
            <table>
                <thead>
                <tr>
                    <th>№ДЗ</th>
                    <th>Статус</th>
                    <th>Оцінка</th>
                    <th>Здати ДЗ</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($submissions)): ?>
                    <?php foreach ($submissions as $submission): ?>
                        <tr>
                            <td>ДЗ №<?= htmlspecialchars($submission['assignment_id']) ?></td>
                            <td><?= htmlspecialchars($submission['status']) ?></td>
                            <td><?= htmlspecialchars($submission['grade']) ?></td>
                            <td>
                                <?php if (empty($submission['path'])): ?>
									<a href="/submission/store?id=<?= $submission['assignment_id'] ?>&class_id=<?= $classId ?>" class="download-btn">Здати ДЗ</a>
                                <?php else: ?>
                                    <?php if (!is_null($submission['grade'])): ?>
                                        <?php if ($submission['grade'] > 2): ?>
                                            <div>Зараховано</div>
                                        <?php else: ?>
                                            <div>Не зараховано</div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div>Завантажено</div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Домашні завдання відсутні.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </form>
    </div>
</main>