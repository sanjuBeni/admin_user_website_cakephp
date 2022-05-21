<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Project extends Entity
{
    protected $_accessible = [
        'project_name' => true,
        'project_cost' => true,
        'user_id' => true,
    ];
}
