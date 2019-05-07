<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blog[]|\Cake\Collection\CollectionInterface $blog
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= $this->request->session()->read('Auth.User.role') ?> Menu</li>
        <li><?= $this->Html->link(__('New Blog'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="blog index large-9 medium-8 columns content">
    <legend><?= __('Search') ?></legend>
    <?= $this->form->control('search', ['label' => false]);?>
    <div class="table-stuff">
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($blog as $blog): ?>
                <tr>
                    <td><?= h($blog->TITLE) ?></td>
                    <td><?= h($blog->DATE) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $blog->BLOGID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $blog->BLOGID]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('document').ready(function () {
        $('#search').keyup(function () {
            let searchkey = $(this).val();
            searchBlog( searchkey );
        });
        function searchBlog( keyword ) {
            let data = keyword;
            $.ajax({
                method: 'get',
                url : "<?php echo $this->Url->build(['controller' => 'Blog', 'action' => 'search']); ?>",
                data: {keyword:data},

                success: function ( response ) {
                    $( '.table-stuff' ).html( response );
                }
            })
        }
    });
</script>
