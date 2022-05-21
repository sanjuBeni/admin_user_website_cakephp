<?= $this->Html->link('Logout', ['action' => 'logout'], ['class' => 'float-right']) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Project List'), ['action' => 'projectList'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link('Add User', ['action' => 'add']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($project) ?>
            <fieldset>
                <legend><?= __('Add Project') ?></legend>
                <div class="form-group">
                    <label for="">Project Name</label>
                    <input type="text" class="form-control" id="pname" name="project_name" placeholder="Project Name">
                    <span style="color: red;">
                        <?php
                        if ($this->Form->isFieldError('project_name')) {
                            echo $this->Form->error('project_name');
                        }
                        ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="">Project Cost</label>
                    <input type="text" class="form-control" id="pcost" name="project_cost" placeholder="Project Cost">
                    <span style="color: red;">
                        <?php

                        ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="">select Users</label>
                    <select class="form-control" name="user_id" id="user">
                        <option selected>Select User</option>
                        <?php foreach ($userData as $value) : ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span style="color: red;">
                        <?php
                        if ($this->Form->isFieldError('user_id'))
                            echo $this->Form->error('user_id')
                        ?>
                    </span>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- <?= $this->Html->script('jquery') ?>
<?= $this->Html->script('app') ?> -->