<?php if($errors->any()): ?>

    <div class="alert alert-block alert-danger">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <strong class="red">
            <?php echo implode('', $errors->all('<li>:message</li>')); ?>

        </strong>
    </div>

<?php endif; ?>