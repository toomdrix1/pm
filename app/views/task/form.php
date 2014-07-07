<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Create a new task...</h4>
</div>
<?php echo Form::model(isset($task) ? $task : null, $action); ?>
	<div class="modal-body">
		<div class="form-group">
			<?php echo Form::label('name', 'Name'); ?>
			<?php echo Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Enter task name')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('description', 'Description'); ?>
			<?php echo Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Enter task description')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('milestone', 'Milestone'); ?>
			<?php echo Form::select('milestone_id', $milestones, isset($task) ? $task->milestone_id : null, array('class'=>'form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('user', 'Users'); ?>
			<?php echo Form::select('user_id', $users, isset($task) ? $task->user_id : null, array('class'=>'form-control','multiple')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('priority', 'Priority'); ?>
			<?php echo Form::select('priority', PM::getPriorityList(), isset($task) ? $task->priority : null, array('class'=>'form-control')); ?>
		</div>

		<div class="well">
			<?php echo Form::label('start_end', 'Start / End dates'); ?>
			<div class="input-daterange input-group" id="datepicker">
				<input type="text" class="input-sm form-control" name="start_date" value="<?php echo isset($task) ? PM::formatDate($task->start_date) : null ?>" />
				<span class="input-group-addon">to</span>
				<input type="text" class="input-sm form-control" name="end_date" value="<?php echo isset($task) ? PM::formatDate($task->end_date) : null ?>" />
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?php echo Form::button('Save changes', array('class'=>'btn btn-primary','type'=>'submit')); ?>
		<?php if (isset($task)): ?>
			<?php echo Form::hidden('id', $task->id); ?>
			<input type="hidden" name="_method" value="PUT" />
		<?php endif; ?>
	</div>
<?php echo Form::close(); ?>