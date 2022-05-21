<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProjectsTable extends Table
{
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('project_name')
            ->requirePresence('project_name', 'create')
            ->minLength('project_name', 5, '* Minimum 5 character filled.')
            ->notEmptyString('project_name', ' * Project name is required.');

        $validator
            ->scalar('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id', '* Please, select user name.')
            ->numeric('user_id', '* Please, select user name.');
        return $validator;
    }
}
