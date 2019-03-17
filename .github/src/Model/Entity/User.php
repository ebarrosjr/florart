<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
class User extends Entity
{
    protected $_accessible = [
        'nome' => true,
        'email' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'active' => true,
        'role' => true
    ];

    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}
