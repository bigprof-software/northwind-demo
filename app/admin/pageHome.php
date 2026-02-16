<?php
	require(__DIR__ . '/incCommon.php');
	$GLOBALS['page_title'] = $Translation['membership management homepage'];
	include(__DIR__ . '/incHeader.php');

	$eo = ['silentErrors' => true];

	if(!sqlValue("SELECT COUNT(1) FROM `membership_groups` WHERE `allowSignup`=1")) {
		$noSignup = true;
		?>
		<div class="alert alert-info">
			<i><?php echo $Translation['attention']; ?></i>
			<br><?php echo $Translation['visitor sign up']; ?>
		</div>
		<?php
	}
?>

<?php
	// get the count of records having no owners in each table
	$arrTables = getTableList();

	foreach($arrTables as $tn => $tc) {
		$countOwned = sqlValue("SELECT COUNT(1) FROM membership_userrecords WHERE tableName='$tn' AND NOT ISNULL(groupID)");
		$countAll = sqlValue("SELECT COUNT(1) FROM `$tn`");

		if($countAll > $countOwned) {
			?>
			<div class="alert alert-info">
				<?php echo $Translation['table data without owner']; ?>
			</div>
			<?php
			break;
		}
	}
?>


<style>
	.admin-dashboard {
		--gap: 2rem;
		--radius: 0.75rem;
	}

	.admin-dashboard *,
	.admin-dashboard *::before,
	.admin-dashboard *::after {
		box-sizing: border-box;
	}

	.admin-dashboard .page {
		width: 100%;
		margin: 0 auto;
		padding: 1.5rem;
		border-radius: 1.25rem;
	}

	.admin-dashboard .panel-title {
		font-size: 1.5em;
		margin-bottom: 0.25rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}

	/* GRID: equal-width columns, equal-height rows */
	.admin-dashboard .grid {
		display: grid;
		gap: var(--gap);
		grid-template-columns: repeat(3, minmax(0, 1fr));
		grid-auto-rows: 1fr;     /* all rows same height on desktop */
		align-items: stretch;    /* panels fill row height */
		transition: grid-template-columns 180ms ease;
	}

	/* When panel 5 is hidden, 2 columns (still equal-height rows) */
	.admin-dashboard .grid.grid--compact {
		grid-template-columns: repeat(2, minmax(0, 1fr));
	}

	/* Base panel styles */
	.admin-dashboard .panel {
		position: relative;
		overflow: hidden;
		min-height: 0;
	}

	.admin-dashboard .panel::before {
		content: "";
		position: absolute;
		inset: -40%;
		pointer-events: none;
	}

	.admin-dashboard .panel-heading {
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin-bottom: 0.65rem;
		position: relative;
		z-index: 1;
		flex-shrink: 0;
	}

	.admin-dashboard .panel-title {
		/* font-size: 0.95rem; */
		font-weight: 600;
		display: flex;
		align-items: center;
		gap: 0.45rem;
	}

	.admin-dashboard .panel-title-badge {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 1.25rem;
		height: 1.25rem;
		border-radius: 999px;
		border: 1px solid;
		font-size: 0.7rem;
	}

	.admin-dashboard .panel-meta {
		font-size: 0.7rem;
		text-transform: uppercase;
		letter-spacing: 0.12em;
	}

	.admin-dashboard .panel-body {
		/* font-size: 0.85rem; */
		position: relative;
		z-index: 1;
		flex: 1; /* fill remaining vertical space */
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	.admin-dashboard .metrics {
		display: flex;
		gap: 0.75rem;
		margin-top: 0.35rem;
		flex-wrap: wrap;
	}

	.admin-dashboard .metric-pill {
		font-size: 0.7rem;
		padding: 0.2rem 0.5rem;
		border-radius: 999px;
		border: 1px solid;
	}

	/* Desktop explicit placement (when panel 5 is visible) */
	@media (min-width: 769px) {
		.admin-dashboard .grid:not(.grid--compact) .panel--1 {
			grid-column: 1;
			grid-row: 1;
		}
		.admin-dashboard .grid:not(.grid--compact) .panel--2 {
			grid-column: 2;
			grid-row: 1;
		}
		.admin-dashboard .grid:not(.grid--compact) .panel--5 {
			grid-column: 3;
			grid-row: 1 / span 2; /* double height */
		}
		.admin-dashboard .grid:not(.grid--compact) .panel--3 {
			grid-column: 1;
			grid-row: 2;
		}
		.admin-dashboard .grid:not(.grid--compact) .panel--4 {
			grid-column: 2;
			grid-row: 2;
		}
	}

	/* Tall optional panel (5) */
	.admin-dashboard .panel--tall {
		min-height: 0;
	}

	.admin-dashboard .panel--tall .panel-body {
		gap: 0.75rem;
	}

	.admin-dashboard .panel--tall-cta {
		margin-top: 0.5rem;
		display: inline-flex;
		align-items: center;
		gap: 0.45rem;
		padding: 0.45rem 0.75rem;
		border-radius: 999px;
		/* font-size: 0.78rem; */
		border: 1px solid;
		align-self: flex-start;
		background: none;
		cursor: pointer;
	}

	.admin-dashboard .panel--tall-cta span.icon {
		width: 18px;
		height: 18px;
		border-radius: 999px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		border: 1px solid;
		font-size: 0.7rem;
	}

	/* MOBILE: 1 column, auto height */
	@media (max-width: 768px) {
		.admin-dashboard .page {
			padding: 1rem;
		}

		.admin-dashboard h1 {
			font-size: 1.2rem;
		}

		.admin-dashboard .grid,
		.admin-dashboard .grid.grid--compact {
			grid-template-columns: 1fr;
			grid-auto-rows: auto; /* height follows content on mobile */
		}

		.admin-dashboard .panel {
			grid-column: auto !important;
			grid-row: auto !important;
		}
	}
</style>

<div class="page-header"><h1><?php echo $Translation['membership management homepage']; ?></h1></div>

<?php
	if(maintenance_mode()) {
		$off_classes = 'btn-default locked_inactive';
		$on_classes = 'btn-danger unlocked_active';
	} else {
		$off_classes = 'btn-success locked_active';
		$on_classes = 'btn-default unlocked_inactive';
	}
?>
<div class="col-md-12 text-right vspacer-lg">
	<label><?php echo $Translation['maintenance mode']; ?></label>
	<div class="btn-group" id="toggle_maintenance_mode">
		<button type="button" class="btn <?php echo $off_classes; ?>"><?php echo $Translation['OFF']; ?></button>
		<button type="button" class="btn <?php echo $on_classes; ?>"><?php echo $Translation['ON']; ?></button>
	</div>
</div>
<script>
	$j('#toggle_maintenance_mode button').click(function() {
		if($j(this).hasClass('locked_active') || $j(this).hasClass('unlocked_inactive')) {
			if(confirm(<?php echo json_encode($Translation['enable maintenance mode?']); ?>)) {
				$j.ajax({
					url: 'ajax-maintenance-mode.php',
					data: {
						status: 'on',
						csrf_token: '<?php echo csrf_token(false, true); ?>'
					},
					complete: function() {
						location.reload();
					}
				});
			}
		} else {
			if(confirm(<?php echo json_encode($Translation['disable maintenance mode?']); ?>)) {
				$j.ajax({
					url: 'ajax-maintenance-mode.php',
					data: {
						status: 'off',
						csrf_token: '<?php echo csrf_token(false, true); ?>'
					},
					complete: function() {
						location.reload();
					}
				});
			}
		}
	});
</script>

<section class="admin-dashboard">
	<main class="page">
		<section class="grid <?php echo $adminConfig['hide_twitter_feed'] ? 'grid--compact' : ''; ?>" id="panel-grid">

			<!-- Newest Updates Panel -->
			<div class="panel panel-info panel--1">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $Translation['newest updates']; ?> <a class="btn btn-default btn-sm hspacer-md" href="pageViewRecords.php?sort=dateUpdated&sortDir=desc"><i class="glyphicon glyphicon-chevron-right text-info"></i></a></h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
					<?php
						$res = sql("SELECT tableName, pkValue, dateUpdated, recID FROM membership_userrecords ORDER BY dateUpdated DESC LIMIT 5", $eo);
						while($row = db_fetch_row($res)) {
							?>
							<tr>
								<th style="min-width: 13em;">
									<?php echo @date($adminConfig['PHPDateTimeFormat'], $row[2]); ?>
								</th>
								<td class="remaining-width">
									<div class="clipped">
										<a href="pageEditOwnership.php?recID=<?php echo $row[3]; ?>">
											<img
												src="images/data_icon.gif"
												alt="<?php echo html_attr($Translation['view record details']); ?>"
												title="<?php echo html_attr($Translation['view record details']); ?>"
											>
										</a>
										<?php echo getCSVData($row[0], $row[1]); ?>
									</div>
								</td>
							</tr>
							<?php
						}
					?>
					</table>
				</div>
			</div>

			<!-- Newest Entries Panel -->
			<div class="panel panel-info panel--2">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $Translation['newest entries']; ?> <a class="btn btn-default btn-sm hspacer-md" href="pageViewRecords.php?sort=dateAdded&sortDir=desc"><i class="glyphicon glyphicon-chevron-right text-info"></i></a></h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
					<?php
						$res = sql("SELECT tableName, pkValue, dateAdded, recID FROM membership_userrecords ORDER BY dateAdded DESC LIMIT 5", $eo);
						while($row = db_fetch_row($res)) {
							?>
							<tr>
								<th style="min-width: 13em;">
									<?php echo @date($adminConfig['PHPDateTimeFormat'], $row[2]); ?>
								</th>
								<td class="remaining-width">
									<div class="clipped">
										<a href="pageEditOwnership.php?recID=<?php echo $row[3]; ?>">
											<img
												src="images/data_icon.gif"
												alt="<?php echo html_attr($Translation['view record details']); ?>"
												title="<?php echo html_attr($Translation['view record details']); ?>"
											>
										</a>
										<?php echo getCSVData($row[0], $row[1]); ?>
									</div>
								</td>
							</tr>
							<?php
						}
					?>
					</table>
				</div>
			</div>

			<!-- Top Members Panel -->
			<div class="panel panel-info panel--3">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $Translation['top members']; ?></h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
					<?php
						$res = sql("SELECT LCASE(`memberID`), COUNT(1) FROM `membership_userrecords` GROUP BY `memberID` ORDER BY 2 DESC LIMIT 5", $eo);
						while($row = db_fetch_row($res)) {
							?>
							<tr>
								<th class="" style="max-width: 10em;">
									<?php if($row[0]) { ?>
										<a href="pageEditMember.php?memberID=<?php echo urlencode($row[0]); ?>" title="<?php echo html_attr($Translation['edit member details']); ?>">
											<i class="glyphicon glyphicon-pencil"></i> <?php echo $row[0]; ?>
										</a>
									<?php } else { ?>
										<i class="glyphicon glyphicon-pencil text-muted"></i> <i><?php echo $Translation['none']; ?></i>
									<?php } ?>
								</th>
								<td class="remaining-width">
									<a href="pageViewRecords.php?memberID=<?php echo urlencode($row[0] ? $row[0] : '{none}'); ?>">
										<img
											src="images/data_icon.gif"
											alt="<?php echo html_attr($Translation['view member records']); ?>"
											title="<?php echo html_attr($Translation['view member records']); ?>"
										>
									</a>
									<?php echo $row[1]; ?> <?php echo $Translation['records']; ?>
								</td>
							</tr>
							<?php
						}
					?>
					</table>
				</div>
			</div>

			<!-- Members Stats Panel -->
			<div class="panel panel-info panel--4">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $Translation['members stats']; ?></h3>
				</div>
				<div class="panel-body">
				<table class="table table-striped table-hover">
					<tr>
						<th class=""><?php echo $Translation['total groups']; ?></th>
						<td class="remaining-width">
							<a href="pageViewGroups.php"title="<?php echo html_attr($Translation['view groups']); ?>"><i class="glyphicon glyphicon-search"></i> <?php echo sqlValue("select count(1) from membership_groups"); ?></a>
						</td>
					</tr>
					<tr>
						<th class=""><?php echo $Translation['active members']; ?></th>
						<td class="remaining-width">
							<a href="pageViewMembers.php?status=2" title="<?php echo html_attr($Translation['view active members']); ?>"><i class="glyphicon glyphicon-search"></i> <?php echo sqlValue("select count(1) from membership_users where isApproved=1 and isBanned=0"); ?></a>
						</td>
					</tr>
					<tr>
						<?php
							$awaiting = intval(sqlValue("select count(1) from membership_users where isApproved=0"));
						?>
						<th class="<?php echo ($awaiting ? "danger" : ""); ?>"><?php echo html_attr($Translation['members awaiting approval']); ?></th>
						<td class="remaining-width">
							<a href="pageViewMembers.php?status=1" title="<?php echo html_attr($Translation['view members awaiting approval']); ?>"><i class="glyphicon glyphicon-search"></i> <?php echo $awaiting; ?></a>
						</td>
					</tr>
					<tr>
						<th class=""><?php echo $Translation['banned members']; ?></th>
						<td class="remaining-width">
							<a href="pageViewMembers.php?status=3" title="<?php echo html_attr($Translation['view banned members']); ?>"><i class="glyphicon glyphicon-search"></i> <?php echo sqlValue("select count(1) from membership_users where isApproved=1 and isBanned=1"); ?></a>
						</td>
					</tr>
					<tr>
						<th class=""><?php echo $Translation['total members']; ?></th>
						<td class="remaining-width">
							<a href="pageViewMembers.php" title="<?php echo html_attr($Translation['view all members']); ?>"><i class="glyphicon glyphicon-search"></i> <?php echo sqlValue("select count(1) from membership_users"); ?></a>
						</td>
					</tr>
					</table>
				</div>
			</div>

			<?php if(!$adminConfig['hide_twitter_feed']) { ?>
				<!-- Feeds Panel -->
				<div class="panel panel-info panel--tall panel--5">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?php echo $Translation['BigProf tweets']; ?>
							<a class="btn btn-default btn-sm hspacer-md" href="https://x.com/bigprof" target="_blank" rel="noopener"><i class="glyphicon glyphicon-new-window text-info"></i></a>
						</h3>
					</div>
					<div class="panel-body">
						<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

						<a href="pageSettings.php?search-settings=twitter">
							<span class="icon"><i class="glyphicon glyphicon-cog"></i></span>
							<span><?php echo $Translation['remove feed']; ?></span>
						</a>
					</div>
				</div>
			<?php } ?>

			<div class="panel panel-info panel--6">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $Translation['do not miss our monthly newsletter']; ?></h3>
				</div>
				<div class="panel-body">
					<!-- background div containing envelope icon, muted, large, rotated -->
					<div style="position: absolute; top: -20px; right: 10px; font-size: 22em; color: #f0f0f0; transform: rotate(15deg); z-index: 0;">
						<i class="glyphicon glyphicon-envelope"></i>
					</div>
					<p style="position: relative; z-index: 1;"><?php echo $Translation['stay updated with latest features']; ?></p>
					<a style="position: relative; z-index: 1;" class="btn btn-primary" href="https://bigprof.com/appgini/newsletter" target="_blank" rel="noopener">
						<i class="glyphicon glyphicon-envelope hspacer-md"></i> <?php echo $Translation['subscribe or read previous issues']; ?>
					</a>
				</div>
			</div>

		</section>
	</main>
</section>


<script>
	$j(function() {
		$j(window).resize(function() {
			$j('.remaining-width').each(function() {
				var panel_width = $j(this).parents('.panel-body').width();
				var other_cell_width = $j(this).prev().width();

				$j(this).attr('style', 'max-width: ' + (panel_width * .9 - other_cell_width) + 'px !important;');
			});
		}).resize();
	})
</script>

<?php include(__DIR__ . '/incFooter.php');
