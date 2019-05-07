<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blog[]|\Cake\Collection\CollectionInterface $blog
 */
?>
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
                    <td><?= h($blog->title) ?></td>
                    <td><?= h($blog->date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $blog->blogid]) ?>
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
