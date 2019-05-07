<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Blog Controller
 *
 * @property \App\Model\Table\BlogTable $Blog
 *
 * @method \App\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BlogController extends AppController
{
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
        $blog = $this->paginate($this->Blog);

        $this->set(compact('blog'));
    }

    public function view($id = null)
    {
        $blog = $this->Blog->get($id, [
            'contain' => []
        ]);

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

    public function isAuthorized($user)
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
            $blogid = (int)$this->request->getParam('pass.0');
            if ($this->Blogs->isOwnedBy($blogid, $user['userid'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
