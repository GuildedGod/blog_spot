<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blog $blog
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav btn">
        <li class="heading"><?= $this->request->getSession()->read('Auth.User.role') ?><?= __(' Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Blog'), ['action' => 'edit', $blog->blogid]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Blog'), ['action' => 'delete', $blog->blogid], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->BLOGID)]) ?> </li>
        <li><?= $this->Html->link(__('List'), ['action' => 'index']) ?> </li>
        <li><?php if (empty($is_editor) || !$is_editor) {
                echo $this->Html->link(__('New Blog'), ['action' => 'add']);
            } ?></li>
        <li><?php if ($is_editor) {
                echo $this->Html->link(__('Publish'), ['action' => 'publish', $blog->blogid], ['class' => 'btn btn-outline-primary']);
            } ?></li>
    </ul>
</nav>
<div class="blog view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($blog->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($blog->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <?= $this->Text->autoParagraph(h($blog->content)); ?>
    </div>
    <br>
    <div class="row">
        <?= $this->Html->link(__('Add Comment'), ['controller' => 'Comments', 'action' => 'add']) ?>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tbody>
        <?php foreach ($cdata as $comment): ?>
            <tr>
                <td><?= h($comment->comment) ?></td>
                <td class="actions float-right">
                <td><?= h($comment->created) ?></td>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
