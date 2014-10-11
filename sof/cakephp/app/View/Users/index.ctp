<h1>Users</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
		<th>Name</th>
        <th>Lastname</th>
		<th>Country</th>
		<th>Role</th>
    </tr>

    <?php foreach ($users as $users): ?>
    <tr>
        <td><?php echo $users['User']['id']; ?></td>
		<td><?php echo $users['User']['username']; ?></td>
		<td><?php echo $users['User']['name']; ?></td>
		<td><?php echo $users['User']['lastname']; ?></td>
		<td><?php echo $users['User']['country']; ?></td>
		<td><?php echo $users['User']['role']; ?></td>
        <td>
   </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>