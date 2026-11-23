<?php

/* Вашата задача е да креирате PHP проект кој ќе овозможи на корисникот да извршува CRUD операции врз различни задачи.
Секоја задача треба да ги содржи следниве својства:

наслов
рок (датум)
приоритет
статус
Користете SQLite база на податоци за чување на сите книги.

Креирајте ги следниве прегледи:

Преглед за листање на задачи: Прикажете ги сите задачи во табела која содржи колони за насловот, рокот, приоритетот и статусот на секоја задача. Во последната колона додадете две копчиња - едно за ажурирање на податоците за задачата и едно за нејзино бришење. Функционалноста за бришење на задачата треба да биде целосно имплементирана и да овозможи корисникот да ја избрише задачата од базата. Над табелата поставете копче за додавање нова задача.

Преглед за додавање нова задача: Обезбедете полиња за внесување на податоците за инасловот, рокот (датум), приоритетот и статусот на новата задача. По зачувувањето на новиот задача, редиректирајте кон прегледот за листање на задачи.

Преглед за ажурирање на продукт: Поставете форма со полиња за уредување на податоците за задачата (наслов, рок, приоритет, статус) кои ќе бидат пополнети со веќе внесените вредности од базата.

Серверска валидација:
При додавање и ажурирање на задача имплементирајте серверска валидација со следниве правила:

Сите полиња се задолжителни.

Приоритетот мора да биде една од вредностите: Low, Medium, High.

Статусот мора да биде една од вредностите: Pending, Done.

По неуспешна валидација прикажете соодветни пораки за грешка и овозможете ги претходно внесените вредности да останат прикажани во формата. По успешна операција (додавање/ажурирање/бришење) направете пренасочување кон прегледот за листање на задачи.

_________

Дополнително барање за бонус поени:

Да се имплементира филтер според Status колоната на index.php */

include 'db_connection.php';

$db = connectDatabase();

$query = "SELECT * FROM tasks";
$result = $db->query($query);

if (!$result) {
    die("Error fetching tasks: " . $db->lastErrorMsg());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View tasks</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
<div style="display: flex; align-items: center; justify-content: space-between">
    <h1>Task List</h1>
    <a href="add_task_form.php">
        Add Task
    </a>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Due date</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($task = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($task['id']); ?></td>
                <td><?php echo htmlspecialchars($task['title']); ?></td>
                <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                <td><?php echo htmlspecialchars($task['priority']); ?></td>
                <td><?php echo htmlspecialchars($task['status']); ?></td>
                <td>
                    <form action="delete_task.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="update_task_form.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No tasks found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>