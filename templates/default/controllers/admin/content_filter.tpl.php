<div class="modal_padding datagrid_dataset_filter">

    <form onsubmit="return contentFilter()">

        <fieldset>

            <legend><?php echo LANG_FILTER; ?></legend>

            <table cellpadding="2" cellspacing="0" border="0" width="100%">

                <?php if (!empty($datasets)){ ?>
                    <tr>
                        <td>
                            <label><?php echo LANG_CP_CTYPE_DATASET; ?></label>
                        </td>
                        <td colspan="2">
                            <select name="dataset" class="dataset">
                                <option value=""></option>
                                <?php foreach($datasets as $dataset){ ?>
                                    <option value="<?php echo $dataset['id']; ?>"><?php echo $dataset['title']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                <?php } ?>

                <?php $index = 0; ?>
                <?php foreach($fields as $field){ ?>
                    <?php if ($field['handler']->filter_type===false) { continue; } ?>
                    <?php if ($field['handler']->is_virtual) { continue; } ?>
                    <?php if ($field['name']=='user'){ $field['name'] = 'user_id'; } ?>
                    <tr>
                        <td>
                            <label><?php html($field['title']); ?></label>
                            <?php echo html_input('hidden', "filters[{$index}][field]", $field['name']); ?>
                        </td>
                        <td>

                            <?php if ($field['handler']->filter_type == 'int') { ?>
                                <select name="filters[<?php echo $index; ?>][condition]">
                                    <option value="eq">=</option>
                                    <option value="gt">&gt;</option>
                                    <option value="lt">&lt;</option>
                                    <option value="ge">&ge;</option>
                                    <option value="le">&le;</option>
                                    <option value="nn"><?php echo LANG_FILTER_NOT_NULL; ?></option>
                                    <option value="ni"><?php echo LANG_FILTER_IS_NULL; ?></option>
                                </select>
                            <?php } ?>

                            <?php if ($field['handler']->filter_type == 'str') { ?>
                                <select name="filters[<?php echo $index; ?>][condition]">
                                    <option value="lk"><?php echo LANG_FILTER_LIKE; ?></option>
                                    <option value="eq">=</option>
                                    <option value="ln"><?php echo LANG_FILTER_NOT_LIKE; ?></option>
                                    <option value="lb"><?php echo LANG_FILTER_LIKE_BEGIN; ?></option>
                                    <option value="lf"><?php echo LANG_FILTER_LIKE_END; ?></option>
                                    <option value="nn"><?php echo LANG_FILTER_NOT_NULL; ?></option>
                                    <option value="ni"><?php echo LANG_FILTER_IS_NULL; ?></option>
                                </select>
                            <?php } ?>

                            <?php if ($field['handler']->filter_type == 'date') { ?>
                                <select name="filters[<?php echo $index; ?>][condition]">
                                    <option value="eq">=</option>
                                    <option value="gt">&gt;</option>
                                    <option value="lt">&lt;</option>
                                    <option value="ge">&ge;</option>
                                    <option value="le">&le;</option>
                                    <option value="dy"><?php echo LANG_FILTER_DATE_YOUNGER; ?></option>
                                    <option value="do"><?php echo LANG_FILTER_DATE_OLDER; ?></option>
                                    <option value="nn"><?php echo LANG_FILTER_NOT_NULL; ?></option>
                                    <option value="ni"><?php echo LANG_FILTER_IS_NULL; ?></option>
                                </select>
                            <?php } ?>

                        </td>
                        <td>
                            <?php
                                $attr = ($field['handler']->filter_hint) ? array('placeholder'=>$field['handler']->filter_hint) : null;
                                echo html_input('text', "filters[{$index}][value]", '', $attr);
                            ?>
                        </td>
                    </tr>
                    <?php $index++; ?>
                <?php } ?>
            </table>

        </fieldset>
        <fieldset>

            <legend><?php echo LANG_CP_TRASH; ?></legend>

            <div>
                <?php echo html_input('hidden', "filters[{$index}][field]", 'is_deleted'); ?>
                <?php echo html_input('hidden', "filters[{$index}][condition]", 'eq'); ?>
                <label><?php echo html_checkbox('filters['.$index.'][value]'); ?> <?php echo LANG_CP_SHOW_ONLY_IN_TRASH; ?></label>
            </div>

        </fieldset>
        <fieldset>

            <legend><?php echo LANG_CONFIG; ?></legend>

            <div>
                <label><?php echo html_checkbox('diff_order', $diff_order); ?> <?php echo LANG_FILTER_SAVE_DIFF_ORDER; ?></label>
            </div>

        </fieldset>

        <?php echo html_submit(LANG_APPLY); ?>

    </form>

</div>
