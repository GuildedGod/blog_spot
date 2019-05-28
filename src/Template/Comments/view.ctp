<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Blog Comments'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="comments view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Blog Reference #') ?></th>
            <td><?= $this->Number->format($comment->blogid) ?></td>
        </tr>
    </table>
    <div class="row">
        <?= $this->Text->autoParagraph(h($comment->comment)); ?>
    </div>
</div>
