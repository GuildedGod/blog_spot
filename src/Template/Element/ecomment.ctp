<div class="row float-left justify-content-end", style="left: 250px; top:10px;">
    <?= $this->Form->create($comments) ?>
    <fieldset>
        <?php
        echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-sm btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>

