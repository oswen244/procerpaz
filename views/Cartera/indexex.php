<div class="panel panel-default required">
    <label for="" class="control-label col-sm-3">Instituciones</label>
    <div class="col-sm-6">
        <select name="" id="instituciones" class="form-control">
             <?php foreach($instituciones as $row){?>
                <option value="<?= $row['id_institucion'];?>"><?= $row['nombre'];?></option>
            <?php }?>
        </select>
        <div class="help-block help-block-error "></div>
    </div>
</div>