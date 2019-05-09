<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
/**
 * Blog Controller
 *
 * @property \App\Model\Table\BlogTable $Blog
 *
 * @method \App\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BlogController extends AppController
{

    function beforeFilter(Event $event)
    {
        $this->Auth->allow(['pleb', 'view']);
        $role = $this->Auth->user('role');
        if ($role == 'editor') {
            $this->set('role', $role);
        }

        if($role == 'editor')
        {
            $this->set('is_editor', true);
        }
        else
        {
            $this->set('is_editor', false);
        }
    }

    public function publish($id = null){

        $blogTable = TableRegistry::get('Blog');
        $query = $blogTable->query();
        $query->update()
            ->set(['publish' => 'pub'])
            ->where(['blogid' => $id])
            ->execute();
        $this->Flash->success(__('The blog has been published.'));
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Serach funtion for serach overlay
     */
    public function search(){
        $this->request->allowMethod('ajax');
        $keyword = $this->request->getQuery('keyword');
        $query = $this->Blog->find('all', [
            'conditions' => ['title LIKE' => '%' .$keyword. '%'],
            'order' => [ 'Blog.blogid' => 'DESC'],
            'limit' => 20
        ]);
        $this->set('blog', $this->paginate($query));
        $this->set('_serialize', ['blog']);
    }

    public function index()
    {
        $blog = $this->paginate($this->Blog);

        $this->set(compact('blog'));
    }

    public function pleb()
    {
        $blog = $this->paginate($this->Blog,  array(
            'recursive' => 0,
            'conditions' => array('blog.publish' => 'pub'),
        ));

        $this->set(compact('blog'));
    }

    public function view($id = null)
    {
        $blog = $this->Blog->get($id, [
            'contain' => []
        ]);
        $session = $this->request->getSession();
        $session->write('Comment', $blog); // pass id to current session
        $this->set('blog', $blog);
    }

    public function add()
    {
        $blog = $this->Blog->newEntity();
        if ($this->request->is('post', 'put')) {

            $blog = $this->Blog->patchEntity($blog, $this->request->getData());
            $blog->authorid = $this->Auth->user('userid');

            $blog = $this->Blog->patchEntity($blog, $this->request->getData());
            if ($this->Blog->save($blog)) {

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blog could not be saved. Please, try again.'));
        }
        $this->set(compact('blog'));
    }

    public function edit($id = null)
    {
        $blog = $this->Blog->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blog = $this->Blog->patchEntity($blog, $this->request->getData());
            if ($this->Blog->save($blog)) {
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blog could not be saved. Please, try again.'));
        }
        $this->set(compact('blog'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blog = $this->Blog->get($id);
        if ($this->Blog->delete($blog)) {
            $this->Flash->success(__('The blog has been deleted.'));
        } else {
            $this->Flash->error(__('The blog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
