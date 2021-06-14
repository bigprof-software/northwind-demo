<?php
	$currDir = __DIR__;
	require("{$currDir}/incCommon.php");
	require("{$currDir}/incHeader.php");
?>

<div class="page-header"><h1>
	<i class="glyphicon glyphicon-console text-danger"></i> 
	<?php echo $Translation['Interactive SQL queries tool']; ?>
</h1></div>

<?php echo csrf_token(); ?>

<div class="form-group">
	<label for="sql" class="control-label"><?php echo $Translation['Enter SQL query']; ?></label>
	<div class="row">
		<div class="col-xs-7 col-sm-8 col-md-9 col-lg-10">
			<textarea class="form-control" id="sql" autofocus></textarea>
			<div class="hidden text-danger tspacer-sm bspacer-lg" id="sql-begins-not-with-select">
				<?php printf($Translation['Query must start with select'], '<code>SELECT&nbsp;</code>'); ?>
			</div>
		</div>
		<div class="col-xs-5 col-sm-4 col-md-3 col-lg-2 text-center">
			<div class="btn-group">
				<button type="button" class="btn btn-default" id="execute"><?php echo $Translation['Display results']; ?></button>
				<button type="button" class="btn btn-default" id="auto-execute" title="<?php echo html_attr($Translation['Update results as you type']); ?>"><i class="glyphicon glyphicon-flash"></i></button>
				<button type="button" class="btn btn-default" id="reset"><i class="glyphicon glyphicon-trash text-danger"></i></button>
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" id="useCache" value="1" checked>
					<?php echo $Translation['Use cache']; ?>
				</label>
			</div>
		</div>
	</div>
</div>

<div id="sql-results" class="hidden table-responsive bspacer-lg">
	<div class="alert alert-info hidden" id="sql-results-truncated">
		<?php printf($Translation['results truncated'], '1000'); ?>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="row-counter">#</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<div class="alert alert-info" id="no-sql-results">
	<i class="glyphicon glyphicon-info-sign"></i> 
	<?php echo $Translation['Results will be displayed here']; ?>
</div>

<div class="hidden" id="results-loading">
	<i class="loop-rotate glyphicon glyphicon-refresh"></i>
	<?php echo $Translation['Loading ...']; ?>
</div>

<div class="alert alert-warning hidden" id="sql-error"></div>

<script src="pageSQL.js"></script>

<?php include("{$currDir}/incFooter.php");
