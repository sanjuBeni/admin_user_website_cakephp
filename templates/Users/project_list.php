<h2>Users Project List</h2>
<?= $this->Html->link('Logout', ['action' => 'logout'], ['class' => 'float-right']) ?>

<?= $this->Html->link('Add Project', ['controller' => 'users', 'action' => 'addProject']) ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Project Name</th>
            <th scope="col">Project Cost</th>
            <th scope="col">User Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projectData as $value) : ?>
            <tr>
                <td><?= $value->projects['project_name'] ?></td>
                <td>$<?= $value->projects['project_cost'] ?></td>
                <td><?= $value->u['name'] ?></td>
                <td>
                    <a href="">Edit</a>
                    <a href="">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>