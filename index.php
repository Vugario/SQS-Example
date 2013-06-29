<?php include( "header.php" ); ?>

<?php 
// Creating messages
$manager = new Services_Amazon_SQS_QueueManager();
?>

<div class="container">

	<header>
		<div class="clearfix">
			<h1 class="pull-left">Amazon SQS</h1>
			<h4 class="pull-right">Testing application</h4>
		</div>
		<hr />
	</header>
	
	<h3>Queues</h3>
	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Queue</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach( $manager->listQueues() as $queue ): ?>
				<tr>
					<td><?php echo $queue; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php if( @$_POST['message'] ): ?>
		
		<?php
		$queue = new Services_Amazon_SQS_Queue( $_POST['queue'] );
		$response = $queue->push( $_POST['message'] );
		?>
		
		<?php if( $response == true ): ?>
		
			<div class="alert alert-success">
				Message received by Amazon
			</div>
			
		<?php else: ?>
		
			<div class="alert alert-error">
				Something went wrong..
			</div>
		
		<?php endif; ?>
		
	<?php endif; ?>
	
	<form action="" class="well" method="POST">
		<fieldset>
			<legend>Send a message</legend>
			
			<div class="control-group">
				<label class="control-label">Queue</label>
				<div class="controls">
					<select name="queue" class="span6">
						<?php foreach( $manager->listQueues() as $queue ): ?>
							<option><?php echo $queue; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Message</label>
				<div class="controls">
					<textarea name="message" class="span6"></textarea>
				</div>
			</div>
			
			<div class="form-actions">
				<input class="btn btn-primary" type="submit" name="submit" value="Send" />
			</div>
		</fieldset>
	</form>
	
</div>