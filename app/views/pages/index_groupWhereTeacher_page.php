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
        <div class="top-right">Привіт, логін!</div>

        <h2>Домашнє завдання №1</h2>
        <table>
            <thead>
            <tr>
                <th>Учні</th>
                <th>Кінцева дата здачі</th>
                <th>Статус</th>
                <th>Оцінка</th>
                <th>Дія</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Учень 1</td>
                <td><input type="date" name="date1" value="2025-07-02"></td>
                <td>
                    <select name="status1">
                        <option value="pass">Здав</option>
                        <option value="not pass" selected>Не здав</option>
                    </select>
                </td>
                <td>
                    <select name="grade1">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                    </select>
                </td>
                <td class="download-section1">
                    <input type="checkbox" id="toggle1" class="toggle-checkbox">
                    <label for="toggle1" class="download-btn">Завантажити</label>
                    <div class="file-select">
                        <select name="file">
                            <option value="file1.pdf">file1.pdf</option>
                            <option value="file2.docx">file2.docx</option>
                            <option value="file3.txt">file3.txt</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Учень 2</td>
                <td><input type="date" name="date2" value="2025-07-02"></td>
                <td>
                    <select name="status2">
                        <option value="pass">Здав</option>
                        <option value="not pass" selected>Не здав</option>
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
                <td class="download-section2">
                    <input type="checkbox" id="toggle2" class="toggle-checkbox">
                    <label for="toggle2" class="download-btn">Завантажити</label>
                    <div class="file-select">
                        <select name="file">
                            <option value="file1.pdf">file1.pdf</option>
                            <option value="file2.docx">file2.docx</option>
                            <option value="file3.txt">file3.txt</option>
                        </select>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h2>Домашнє завдання №2</h2>
        <table>
            <thead>
            <tr>
                <th>Учні</th>
                <th>Кінцева дата здачі</th>
                <th>Статус</th>
                <th>Оцінка</th>
                <th>Дія</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Учень 1</td>
                <td><input type="date" name="date3" value="2025-07-02"></td>
                <td>
                    <select name="status3">
                        <option value="pass">Здав</option>
                        <option value="not pass" selected>Не здав</option>
                    </select>
                </td>
                <td>
                    <select name="grade3">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                    </select>
                </td>
                <td class="download-section1">
                    <input type="checkbox" id="toggle3" class="toggle-checkbox">
                    <label for="toggle3" class="download-btn">Завантажити</label>
                    <div class="file-select">
                        <select name="file">
                            <option value="file1.pdf">file1.pdf</option>
                            <option value="file2.docx">file2.docx</option>
                            <option value="file3.txt">file3.txt</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Учень 2</td>
                <td><input type="date" name="date4" value="2025-07-02"></td>
                <td>
                    <select name="status4">
                        <option value="pass">Здав</option>
                        <option value="not pass" selected>Не здав</option>
                    </select>
                </td>
                <td>
                    <select name="grade4">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                    </select>
                </td>
                <td class="download-section">
                    <input type="checkbox" id="toggle4" class="toggle-checkbox">
                    <label for="toggle4" class="download-btn">Завантажити</label>
                    <div class="file-select">
                        <select name="file">
                            <option value="file1.pdf">file1.pdf</option>
                            <option value="file2.docx">file2.docx</option>
                            <option value="file3.txt">file3.txt</option>
                        </select>
                    </div>
                </td>
            </tr>
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
