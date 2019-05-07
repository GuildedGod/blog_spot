<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="card bg-light">
        <article class="card-body align-content-center">
            <div class="large-6 columns" style="left: 250px; top:10px;">
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <legend class="bg-light"><?= __('Register') ?></legend>
                    <?php
                    echo $this->Form->control('role', [
                        'required' => true,
                        'options' => ['editor' => 'Editor', 'author' => 'Author']]);
                    echo $this->Form->control('email', ['required' => true, 'placeholder' => 'Email']);
                    echo $this->Form->control('username', ['required' => true, 'placeholder' => 'Username']);
                    echo $this->Form->control('password', ['required' => true, 'placeholder' => 'Password']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-block btn-primary']) ?>
                <?= $this->Form->end() ?>
                <p class="text-center">Have an
                    account? <?= $this->Html->Link(__('Login'), ['action' => '/login']) ?></p>
            </div>
        </article>
    </div>
</div>
