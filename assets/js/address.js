$(document).ready(function(){
	$('#province_id').change(function(){
		var province_id = $(this).val();
		$.ajax({
			url: "<?php echo base_url('students/getMunicipalities'); ?>", // Fixed PHP echo
			type: "post",
			data: {province_id: province_id},
			success: function(response){
				$('#municipal_id').html(response);
			}
		});
	});

	$('#municipal_id').change(function(){ // Event listener for Municipality dropdown
		var municipal_id = $(this).val();
		$.ajax({
			url: "<?php echo base_url('students/getBarangays'); ?>", // URL to fetch Barangays
			type: "post",
			data: {municipal_id: municipal_id},
			success: function(response){
				$('#barangay_id').html(response);
			}
		});
	});
});
