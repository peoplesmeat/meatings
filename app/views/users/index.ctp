<h1>HERE</h1>
<?php foreach ($users as $user): ?>
<tr>
<td><?php echo $user['User']['id']; ?></td>
<td>
<?php echo $html->link($user['User']['username'],"/posts/view/".$user['User']['id']); ?>
</td>
<td><?php echo $user['User']['password']; ?></td>
<td><?php echo $user['User']['email']; ?></td>
</tr>
<?php endforeach; ?>