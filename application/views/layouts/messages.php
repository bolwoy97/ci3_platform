<? $errors = $this->session->flashdata('errors');
                        if($errors){?>
<div class="alert alert-danger">
    <?foreach ($errors as $key => $error_item) {?>
    <p>* <?= $error_item?></p>
    <?}?>
</div>
<?}?>


<? $success = $this->session->flashdata('success');
                        if($success){?>
<div class="alert alert-success">
    <?foreach ($success as $key => $success_item) {?>
    <p>* <?= $success_item?></p>
    <?}?>
</div>
<?}?>

<? $warning = $this->session->flashdata('warning');
                        if($warning){?>
<div class="alert alert-warning">
    <?foreach ($warning as $key => $warning_item) {?>
    <p>* <?= $warning_item?></p>
    <?}?>
</div>
<?}?>
