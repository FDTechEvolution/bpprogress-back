<div class="card-box mt-2">
    <div class="col-12 pt-0" style="padding: 20px;">
        <div class="form-group row pb-0 mb-2">
            <label class="col-12 col-form-label">อัพโหลดรูปภาพสินค้า</label>
        </div>
        <hr>
        <div class="row pb-2 py-2 px-3">
            <div class="col-md-12 portlets">
                <!-- Your awesome content goes here -->
                <div class="m-b-30">
                    <?= $this->Form->create('productimage', ['id' => 'dropzone', 'class' => 'form-horizontal dropzone', 'role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    <?= $this->Form->end() ?>
                    <div class="clearfix text-center mt-2">
                        <button type="button" id="dropzone-submit" class="btn btn-danger btn-rounded waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* .dropzone .dz-preview.dz-error .dz-error-mark {
        display: none;
    }
    .dropzone .dz-preview.dz-error .dz-error-message {
        display: none;
    } */
    .dropzone {
        border: 2px dashed rgba(0,0,0,0.3);
    }
</style>

<?= $this->Html->script('assets/jquery.min.js') ?>
<?= $this->Html->script('assets/libs/dropzone/dropzone.js') ?>
<?= $this->Html->script('assets/jquery.core.js') ?>

<script>
    var form = document.getElementById("dropzone");

    document.getElementById("dropzone-submit").addEventListener("click", function () {
        form.submit();
    });
</script>