
<?php
// Load users.json
$usersFile = 'json/users.json';
$usersData = json_decode(file_get_contents($usersFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['block'])) {
    foreach ($usersData as &$user) {
        if ($user['username'] === $_POST['username']) {
            $user['blocked'] = $_POST['block'] === 'true';
            break;
        }
    }
    file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT));
}
?>
<h2>Manage Users</h2>
<table class="table">
    <thead>
    <tr>
        <th>Username</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($usersData as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= isset($user['blocked']) && $user['blocked'] ? 'Blocked' : 'Active' ?></td>
            <td>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="username" value="<?= htmlspecialchars($user['username']) ?>">
                    <select name="block" class="form-select">
                        <option value="false" <?= empty($user['blocked']) ? 'selected' : '' ?>>Active</option>
                        <option value="true" <?= !empty($user['blocked']) ? 'selected' : '' ?>>Blocked</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm" style="width: 40px; height: 40px; padding: 0; text-align: center;">✔</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>