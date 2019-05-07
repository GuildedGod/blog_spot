<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="card bg-light">
        <article class="card-body align-content-md-center">
            <div class="large-6 columns" style="left: 250px; top:10px;">
                <?= $this->Form->create() ?>
                <fieldset>
                    <legend class="bg-light"><?= __('Login') ?></legend>
                    <?php
                    echo $this->Form->control('username', ['placeholder' => 'Username']);
                    echo $this->Form->control('password', ['placeholder' => 'Password']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Login'), ['class' => 'btn btn-block btn-primary']) ?>
                <?= $this->Form->end() ?>
                <p class="text-center">Dont Have an
                    account? <?= $this->Html->Link(__('Register Here'), ['action' => '/register']) ?></p>
            </div>
        </article>
    </div>
</div>
