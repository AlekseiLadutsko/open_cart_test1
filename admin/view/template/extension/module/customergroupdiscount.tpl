<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-customergroupdiscount" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customergroupdiscount" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="customergroupdiscount_status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="customergroupdiscount_status" id="customergroupdiscount_status" class="form-control">
                                <?php if ($customergroupdiscount_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" for="customergroupdiscount_groupid"><?php echo $group_user_name; ?></label>
                        <div class="col-sm-10">
                            <select name="customergroupdiscount_groupid" id="customergroupdiscount_group" class="form-control">
                                <?php foreach ($customer_groups as $group) { ?>
                                    <option
                                            <?php if($customergroupdiscount_groupid === $group['customer_group_id']) echo "selected='selected'";?>
                                            value="<?php echo $group['customer_group_id']; ?>"><?php echo $group['name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" for="customergroupdiscount_discount"><?php echo $sale_count; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="customergroupdiscount_discount" placeholder="<?php echo $sale_count; ?>" id="customergroupdiscount_discount" class="form-control" value = "<?php echo $customergroupdiscount_discount; ?>" />
                        </div>
                        <div class="pull-right">
                            <br/>
                            <button type="button" title="Применить" class="btn btn-primary" id = "changePriceForDiscountedGroup">Применить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">
        $('#changePriceForDiscountedGroup').load('index.php?route=product/product/');
</script>