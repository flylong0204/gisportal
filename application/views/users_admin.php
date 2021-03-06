<div class="page-header clearfix">
	<h1 class="col-md-8"><?php echo $title; ?></h1>
</div>

<?php echo $this->session->flashdata('alert'); ?>

<div class="col-md-12">

    <table data-pagination="true" data-search="true" data-toggle="table" data-show-pagination-switch="true">
        <thead>
        <tr>
            <th data-sortable="true" data-field="gp_username"><?php echo $this->lang->line('gp_username'); ?></th>
            <th data-sortable="true" data-field="gp_email"><?php echo $this->lang->line('gp_email'); ?></th>
            <th data-sortable="true" data-field="gp_name"><?php echo $this->lang->line('gp_name'); ?></th>
            <th data-sortable="true" data-field="gp_registered"><?php echo $this->lang->line('gp_registered'); ?></th>
            <th data-sortable="true" data-field="gp_count_login"><?php echo $this->lang->line('gp_count_login'); ?></th>
            <th data-sortable="true" data-field="gp_last_login"><?php echo $this->lang->line('gp_last_login'); ?></th>
            <th data-sortable="true" data-field="gp_admin">Admin</th>
            <th><?php echo $this->lang->line('gp_action'); ?></th>
        </tr>
        </thead>
	  <?php foreach ($users as $user_item): ?>

		<tr>
		  <td class="col-md-2"><?php echo $user_item['user_name']; ?></td>
		  <td class="col-md-2"><?php echo $user_item['user_email']; ?></td>
		  <td class="col-md-2"><?php echo $user_item['display_name']; ?></td>
		  <td class="col-md-2"><?php echo set_datestr($user_item['registered']); ?></td>
		  <td class="col-md-2"><?php echo $user_item['count_login']; ?></td>
		  <td class="col-md-2"><?php echo set_datestr($user_item['last_login']); ?></td>
		  <td class="col-md-2"><?php echo set_check_icon($user_item['admin']); ?></td>
		  <td class="col-md-2">
			<a class="btn btn-primary" href="<?php echo site_url('users/edit/'.$user_item['user_id']); ?>">
				<?php echo $this->lang->line('gp_edit'); ?>
			</a>

		  </td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
