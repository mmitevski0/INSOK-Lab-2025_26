<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    $stmt = $db->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $task = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid task ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task</title>
</head>
<body>
<h1>Update Task</h1>

<?php if ($task): ?>
    <form action="update_task.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id']); ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required><br><br>
        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" required><br><br>
        <label for="priority">Priority:</label>
        <select>
            <option value="Low" <?php if ($task['priority']=='Low') echo 'selected="selected"';?>>Low</option>
            <option value="Medium" <?php if ($task['priority']=='Medium') echo 'selected="selected"';?>>Meidum</option>
            <option value="High" <?php if ($task['priority']=='High') echo 'selected="selected"';?>>High</option>
        </select>
        <br><br>
        <label for="status">Status:</label>
        <select>
            <option value="Pending" <?php if ($task['status']=='Pending') echo 'selected="selected"';?>>Pending</option>
            <option value="Done" <?php if ($task['status']=='Done') echo 'selected="selected"';?>>Done</option>
        </select>
        <br><br>
        <button type="submit">Update Task</button>
    </form>
<?php else: ?>
    <p>Task not found.</p>
<?php endif; ?>
</body>
</html>