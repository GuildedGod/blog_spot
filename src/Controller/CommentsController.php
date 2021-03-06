<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use phpDocumentor\Reflection\Types\This;

class CommentsController extends AppController
{

    public function beforeFilter(Event $event){
        $this->Auth->allow(['add', 'view']);
    }

    public function index()
    {
        $id = $this->getRequest()->getSession()->read('Comment.blogid');
        $comments = $this->paginate($this->Comments, array(
            'recursive' => 0,
            'conditions' => array('blogid' => $id),
        ));

        $this->set(compact('comments'));
    }

    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);

        $this->set('comment', $comment);
    }

    /**
     * add comment to current blog
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            $comment->blogid = $this->getRequest()->getSession()->read('Comment.blogid');
            $comment->userid = $this->getRequest()->getSession()->read('Comment.authorid');
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                $check = $this->Auth->user();
                if(isset($check)){
                    return $this->redirect( ['controller' => 'Blog', 'action' => 'index']);
                }else{
                    return $this->redirect($this->referer());
                }

            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $this->set(compact('comment'));
    }

    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $this->set(compact('comment'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
