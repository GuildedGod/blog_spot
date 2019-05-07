<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blog $blog
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Blog'), ['action' => 'edit', $blog->blogid]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Blog'), ['action' => 'delete', $blog->blogid], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->blogid)]) ?> </li>
        <li><?= $this->Html->link(__('List Blog'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blog'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="blog view large-9 medium-8 columns content">
    <h3><?= h($blog->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($blog->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Blogid') ?></th>
            <td><?= $this->Number->format($blog->blogid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Authorid') ?></th>
            <td><?= $this->Number->format($blog->authorid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($blog->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($blog->content)); ?>
    </div>
</div>
