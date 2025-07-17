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
    </style>
</head>
<body>

<header>
    <h1>НАЗВА ГРУПИ, ДЕ КОРИСТУВАЧ СТУДЕНТ</h1>
</header>

<main>
    <div class="form-block">
        <div class="top-right">Привіт, логін!</div>
        <h2>Перелік домашніх завдань</h2>
        <form method="post" action="#">
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
                <tr>
                    <td>ДЗ №1</td>
                    <td>
                        <select name="status1">
                            <option value="active" selected>Активне</option>
                            <option value="inactive">Неактивне</option>
                        </select>
                    </td>
                    <td>
                        <select name="grade1">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4" selected>4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                    <td>
                        <a href="index_handInHomework_page.php" class="download-btn">Здати ДЗ</a>
                    </td>
                </tr>
                <tr>
                    <td>ДЗ №2</td>
                    <td>
                        <select name="status2">
                            <option value="active">Активне</option>
                            <option value="inactive" selected>Неактивне</option>
                        </select>
                    </td>
                    <td>
                        <select name="grade2">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5" selected>5</option>
                        </select>
                    </td>
                    <td>
                        <a href="index_handInHomework_page.php" class="download-btn">Здати ДЗ</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</main>

<footer>
    <p>Наша школа пропонує сучасне навчання програмуванню, веб-технологіям і проєктному мисленню. Запрошуємо!</p>
</footer>

</body>
</html>