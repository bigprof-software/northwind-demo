$j(function() {
	var runningAjaxRequest = null;
	var cache = {};

	var getResults = function() {
		if(runningAjaxRequest !== null) {
			runningAjaxRequest.abort();
			runningAjaxRequest = null;
		}

		var sql = $j('#sql').val();
		if(!validSql(sql)) return noResults();

		if(cache[sql] !== undefined && $j('#useCache').prop('checked'))
			return showResults(cache[sql]);

		runningAjaxRequest = $j.ajax({
			url: 'ajax-sql.php',
			data: {    sql: sql, csrf_token: $j('#csrf_token').val() },
			beforeSend: function() {
				$j('#sql-error').addClass('hidden');
				if(!$j('#auto-execute').hasClass('active')) noResults();
				$j('#results-loading').removeClass('hidden');
			},
			error: noResults,
			success: function(resp) {
				cache[sql] = resp;
				showResults(resp);
			},
			complete: function() {
				runningAjaxRequest = null;
				$j('#results-loading').addClass('hidden');
			}
		})
	}

	var showResults = function(resp) {
		resetResults();
		if(
			typeof(resp) != 'object' ||
			resp.titles === undefined ||
			resp.data === undefined ||
			!resp.data.length
		) return noResults(resp);

		var thead = $j('#sql-results > table > thead > tr'),
			tbody = $j('#sql-results > table > tbody'),
			tr = null;

		for(var i = 0; i < resp.titles.length; i++)
			$j('<th>' + resp.titles[i] + '</th>').appendTo(thead);

		for(var ri = 0; ri < resp.data.length; ri++) {
			tr = $j('<tr></tr>');
			$j('<td class="row-counter">' + (ri + 1) + '</td>').appendTo(tr);

			for(i = 0; i < resp.data[ri].length; i++)
				$j('<td>' + resp.data[ri][i] + '</td>').appendTo(tr);

			tr.appendTo(tbody);
		}

		$j('#sql-results').removeClass('hidden');
		$j('#no-sql-results, #sql-error').addClass('hidden');

		$j('#sql-results-truncated').toggleClass('hidden', resp.data.length != 1000);
	}

	var noResults = function(resp) {
		$j('#sql-results').addClass('hidden');
		$j('#no-sql-results').removeClass('hidden');
		$j('#results-loading').addClass('hidden');

		var hasError = (resp !== undefined && resp.error);
		$j('#sql-error').toggleClass('hidden', !hasError).html(hasError ? resp.error : '');
	}

	var validSql = function(sql) {
		if(sql === undefined) sql = $j('#sql').val();
		$j('#sql-begins-not-with-select').toggleClass('hidden', /^\s*SELECT\s+/i.test(sql));
		return /^\s*SELECT\s+.*?\s+FROM\s+\S+/i.test(sql);
	}

	var resetResults = function() {
		var table = $j('#sql-results > table');
		table.find('th:not(.row-counter)').remove();
		table.find('tbody > tr').remove();
	}

	$j('#execute').on('click', getResults);
	$j('#sql').on('keyup', function() {
		if(!validSql()) return;
		if(!$j('#auto-execute').hasClass('active')) return;
		getResults();
	});
	$j('#useCache').on('click', function() {
		if(!$j(this).prop('checked'))
			getResults();
	})

	$j('#reset').on('click', function() {
		$j('#sql').val('').focus();
		resetResults();
		noResults();
	})

	// lock/unlock #execute button
	$j('#auto-execute').on('click', function() {
		var enable = $j(this).hasClass('active');
		$j(this).toggleClass('active', !enable);
		$j('#execute').prop('disabled', !enable);  
	})
})
