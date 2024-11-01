jQuery(document).ready(function($) {
	$('.wp-hgrant-datepicker').datepicker({
		dateFormat: 'mm/dd/y'
	});

	$('.wp-hgrant-datepicker-special').datepicker({
		dateFormat: 'mm/dd'
	});

	var counter = new Date().getTime();

	function add_grant(event) {
		if(event && event.preventDefault) {
			event.preventDefault();
		}

		$('.wp-hgrant-datepicker').datepicker('destroy');

		counter++;

		$($('.wp-hgrant-grant-template:first').html().replace(/XXX/g, counter)).appendTo($('.wp-hgrant-grants')).find('input:first').focus();

		$('.wp-hgrant-datepicker').each(function(index, element) {
			$(element).datepicker({
				dateFormat: 'mm/dd/y'
			}).datepicker('setDate', $(element).val());
		});
	}

	function remove_grant(event) {
		if(event && event.preventDefault) {
			event.preventDefault();
		}

		$(this).parents('.wp-hgrant-grant').remove();
	}

	if($('.wp-hgrant-grants').size() > 0) {
		add_grant();
	}

	$(document).on('click', '.wp-hgrant-grant-add', add_grant);
	$(document).on('click', '.wp-hgrant-grant-remove', remove_grant);
	$(document).on('change', '.wp-hgrant-datepicker[name*="dtstart"]', function(event) {
		var $this = $(this),
			$end = $this.parents('tr').next('tr').find('.wp-hgrant-datepicker[name*="dtend"]'),
			duration_amount = parseInt($this.data('duration-amount') ? $('#' + $this.data('duration-amount')).val() : WP_hGrant.default_duration_amount),
			duration_period = $this.data('duration-period') ? $('#' + $this.data('duration-period')).val() : WP_hGrant.default_duration_period;

		// Find the matching dtend and change it
		var d = new Date($this.val());

		if('months' === duration_period) {
			d.setMonth(d.getMonth() + parseInt(duration_amount));
		} else if('years' === duration_period) {
			d.setFullYear(d.getFullYear() + parseInt(duration_amount));
		}

		$end.datepicker('setDate', d);
	});

	function add_geo_area(event) {
		if(event && event.preventDefault) {
			event.preventDefault();
		}

		counter++;

		var $clone = $($('.wp-hgrant-geo-area-template:first').html().replace(/XXX/g, counter)).appendTo($('.wp-hgrant-geo-areas'));

		$clone.find('select').change();
	}

	function remove_geo_area(event) {
		if(event && event.preventDefault) {
			event.preventDefault();
		}

		$(this).parents('.wp-hgrant-geo-area').remove();
	}

	$(document).on('click', '.wp-hgrant-geo-area-add', add_geo_area);
	$(document).on('click', '.wp-hgrant-geo-area-remove', remove_geo_area);


	$(document).on('change', '.wp-hgrant-other-chooser', function() {
		var $other = $(this).siblings('.wp-hgrant-other');

		if($(this).val() == '00') {
			$other.show();
		} else {
			$other.hide();
		}
	})

	$('.wp-hgrant-other-chooser').change();

	$(document).on('change', '.wp-hgrant-geo-area-component-picker', function() {
		var $this = $(this),
			$geo_area = $this.parents('.wp-hgrant-geo-area'),
			$row = $geo_area.find('[data-wp-hgrant-geo-area-component="' + $this.val() + '"]'),
			checked = $this.is(':checked');

		if(checked) {
			$row.show();
		} else {
			$row.hide();
		}
	});

	$('.wp-hgrant-geo-area-component-picker').change();

	$(document).on('change', '.wp-hgrant-changes-grantee-name', function() {
		var $this = $(this),
			$grantee_name = $this.parents('table').find('.wp-hgrant-grantee-name');

		if('' === $grantee_name.val()) {
			$grantee_name.val($this.val());
		}
	});

	$(document).on('change', '[name="post_title"]', function() {
		var $this = $(this),
			$grantee_name = $('.wp-hgrant-grantee-name');

		if('' === $grantee_name.val()) {
			$grantee_name.val($this.val());
		}
	});
});
