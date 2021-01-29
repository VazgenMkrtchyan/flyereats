<!-- BOX -->
<div class="widget-box widget-color-blue2">
    <div class="widget-header">
        <h5 class="widget-title">
            <i class="ace-icon fa fa-briefcase"></i>
            <?php echo trans('back.company_profiles'); ?>

            <span class="per_page">
                <?php echo Form::select('per_page', rangePerPage(), sessionOrWebc('ai_compprofiles_no', Route::currentRouteName()), ['class'=>'form-control']);; ?>

            </span>
        </h5>
    </div>

    <?php echo str_replace('/?', '?', $compprofiles->appends(Input::all())->render()); ?>


    <div class="widget-body">
        <div class="widget-main">

            <?php if($compprofiles->count()): ?>

                <table class="table table-striped table-hover">
                    <tbody>

                    <?php foreach($compprofiles as $compprofile): ?>

                        <tr>
                            <td>
                                <div class="row">

                                    <div class="col-sm-9 bigger-110">
                                        <?php echo trans('back.company_name'); ?>: <strong><?php echo $compprofile->name; ?></strong>
                                    </div>

                                    <!-- ACTIONS -->
                                    <div class="col-sm-3">
                                        <div class="margin-t-10 visible-xs"></div>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                                                    <i class="fa fa-cogs"></i> <?php echo trans('back.company_actions'); ?>

                                                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                </button>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a href="<?php echo route('admin.company-profiles.edit', $compprofile->id);; ?>"><i class="fa fa-pencil"></i> <?php echo trans('back.edit'); ?></a>
                                                    </li>

                                                    <li class="divider"></li>

                                                    <li>
                                                        <a href="<?php echo route('admin.company-profiles.destroy', $compprofile->id);; ?>" data-delete="<?php echo csrf_token(); ?>" data-confirm="<?php echo trans('back.delete_company_confirm'); ?>"><i class="fa fa-trash-o"></i> <?php echo trans('back.delete_company'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./ACTIONS -->


                                </div>

                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>

            <?php else: ?>

                <h4 class="red"><?php echo trans('back.no_companies_found'); ?></h4>

            <?php endif; ?>

            <?php echo str_replace('/?', '?', $compprofiles->appends(Input::all())->render()); ?>


        </div>
    </div>
</div>