<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class BlogTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('blog');
        $this->setDisplayField('title');
        $this->setPrimaryKey('blogid');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('blogid')
            ->allowEmptyString('blogid', 'create');

        $validator
            ->integer('authorid')
            ->allowEmptyString('authorid', false);

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->allowEmptyString('title', false);

        $validator
            ->scalar('content')
            ->maxLength('content', 4294967295)
            ->requirePresence('content', 'create')
            ->allowEmptyString('content', false);

        $validator
            ->maxLength('publish', 8)
            ->allowEmptyString('publish', false);

        return $validator;
    }
}
