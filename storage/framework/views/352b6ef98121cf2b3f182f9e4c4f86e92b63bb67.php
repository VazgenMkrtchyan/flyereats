<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default navbar-collapse">

	<div class="navbar-container" id="navbar-container">
		<div class="navbar-header pull-left">
			<!-- #section:basics/navbar.layout.brand -->
			<a href="<?php echo route('admin.dashboard'); ?>" class="navbar-brand">
				<small>
					<i class="fa fa-car"></i>
					Admin Panel
				</small>
			</a>

			<!-- /section:basics/navbar.layout.brand -->

			<!-- #section:basics/navbar.toggle -->
			<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".sidebar">
				<span class="sr-only"><?php echo trans('back.toggle_sidebar'); ?></span>

				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- /section:basics/navbar.toggle -->
		</div>

		<!-- /section:basics/navbar.dropdown -->
	</div><!-- /.navbar-container -->
</div>

<!-- /section:basics/navbar.layout -->