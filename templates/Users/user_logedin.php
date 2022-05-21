<h2>User Details</h2>

<?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'], [
    'class' => 'float-right'
]) ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">User Name</th>
            <th scope="col">User Email</th>
            <th scope="col">Project Name</th>
            <th scope="col">Project Cost</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projectList as $value) : ?>
            <tr>
                <td><?= $userData->name ?></td>
                <td><?= $userData->email ?></td>
                <td><?= $value->project_name ?></td>
                <td>$<?= $value->project_cost ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>