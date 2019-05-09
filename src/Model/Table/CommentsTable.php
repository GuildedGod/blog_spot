<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table
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

        $this->setTable('comments');
        $this->setDisplayField('commentid');
        $this->setPrimaryKey('commentid');
    }

    /**
     * Default validation rules.
     *
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('commentid')
            ->allowEmptyString('commentid', 'create');

        $validator
            ->integer('blogid')
            ->allowEmptyString('blogid', false);

        $validator
            ->integer('userid')
            ->allowEmptyString('userid', false);

        $validator
            ->scalar('comment')
            ->maxLength('comment', 4294967295)
            ->requirePresence('comment', 'create')
            ->allowEmptyString('comment', false);

        return $validator;
    }
}
