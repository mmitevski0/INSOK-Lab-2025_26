<?php

/* Направете систем за управување со настани. Системот треба да овозможи додавање, ажурирање, бришење и прикажување на настани, со користење на SQLite база за чување на податоците, со задолжителна регистрација, најава и проверки за автентикација.. За поврзување и работа со базата, користете PDO или SQLite3.

Податоци кои се чуваат за даден настан:

Име на настан
Локација
Датум на одржување
Тип на настан (јавен или приватен)
Барања:
1. Табела со настани

Прикажете ги сите настани во табела која ќе ги содржи следниве колони:
Име, Датум, Локација, Тип на настан.
Акции за ажурирање и бришење.
Над табелата додадете копче за додавање нов настан.
2. Форма за додавање настан

При клик на копчето за додавање, редиректирајте кон форма која содржи:

Текст поле за име на настан.
Текст поле за локација.
Датум поле за датум на одржување.
Селект поле за тип на настан (јавен/приватен).
3. Бришење на настан

При клик на копчето за бришење:
Ако настанот е приватен, спречете бришење и прикажете порака: „Приватен настан не може да се избрише.“
Ако е јавен, избришете го записот од базата.
4. Ажурирање на настан

При клик на копчето за ажурирање:

Отворете форма со веќе внесените податоци за тој настан.
Овозможете измена на сите полиња.
Зачувајте ги измените во базата.

5. Регистрација и автентикација

Овозможете регистрација на корисници, најава и нивно одјавување.
Пристап до листата на настани, формата за додавање, формата за ажурирање и акцијата за бришење да имаат само најавени корисници.
* Во сите обработувачи за додавање, ажурирање и бришење додадете проверка: ако корисникот не е најавен, прекинете ја акцијата и пренасочете кон страницата за најава со порака „Немате пристап.“ */

include 'database/db_connection.php';
include 'jwt_helper.php';

session_start();

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: pages/auth/login.php");
    exit;
}

$db = connectDatabase();

$query = "SELECT * FROM events";
$result = $db->query($query);

if (!$result) {
    die("Error fetching expenses: " . $db->errorCode());
}
?>

<body>
<div>
    <h1>Events List</h1>
    <a href="pages/create.php">
        Add Event
    </a>
    <a href="handlers/auth/logout_handler.php">
        Logout
    </a>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Location</th>
        <th>Date</th>
        <th>Type</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($event = $result->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['id']); ?></td>
                <td><?php echo htmlspecialchars($event['name']); ?></td>
                <td><?php echo htmlspecialchars($event['location']); ?></td>
                <td><?php echo htmlspecialchars($event['date']); ?></td>
                <td><?php echo htmlspecialchars($event['type']); ?></td>
                <td>
                    <?php if ($event['type'] == 'public'): ?>
                        <form action="handlers/delete_handler.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif ?>
                    <form action="pages/edit.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No events found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>