<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Create a new message...</h4>
</div>
<?php echo Form::model(isset($message) ? $message : null, $action); ?>
	<div class="modal-body">
		<div class="form-group">
			<?php echo Form::label('name', 'Title'); ?>
			<?php echo Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Enter message title')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('description', 'Message'); ?>
			<?php echo Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Enter message')); ?>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?php echo Form::button('Save changes', array('class'=>'btn btn-primary','type'=>'submit')); ?>
		<?php if (isset($message)): ?>
			<?php echo Form::hidden('id', $message->id); ?>
			<input type="hidden" name="_method" value="PUT" />
		<?php else: ?>
			<?php echo Form::hidden('project_id', $project_id); ?> 
		<?php endif; ?>
		<?php echo Form::hidden('user_id', Auth::user()->id); ?> 
	</div>
<?php echo Form::close(); ?>