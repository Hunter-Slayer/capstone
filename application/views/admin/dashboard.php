<main id="main" class="main">
	<div class="pagetitle">
		<h1>Dashboard</h1>
	</div><!-- End Page Title -->

	<section class="section dashboard">
		<div class="row">

			<div class="col-lg-12">
				<div class="row">

					<!-- Sales Card -->
					<div class="col-xxl-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<a href="<?= base_url('admin/scholar/government') ?>" class="text-decoration:none">
									<h5 class="card-title">Government Scholarships</h5>
								</a>
								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-bank2"></i>
									</div>
									<div class="ps-3">
										<h6><?= $totalGovScholar ?></h6>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- End Sales Card -->

					<!-- Revenue Card -->
					<div class="col-xxl-4 col-md-6">
						<div class="card info-card revenue-card">


							<div class="card-body">
								<a href="<?= base_url('admin/scholar/private') ?>" class="text-decoration:none">
									<h5 class="card-title">Private Scholarship</h5>
								</a>

								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-cash"></i>
									</div>
									<div class="ps-3">
										<h6><?= $totalPrivateScholar ?></h6>

									</div>
								</div>
							</div>

						</div>
					</div><!-- End Revenue Card -->

					<!-- Customers Card -->
					<div class="col-xxl-4 col-xl-12">

						<div class="card info-card customers-card">



							<div class="card-body">
								<a href="<?= base_url('admin/scholar/activegov') ?>" class="text-decoration:none">
									<h5 class="card-title">Active Government Scholarships</span></h5>
								</a>

								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-currency-exchange"></i>
									</div>
									<div class="ps-3">
										<h6>
											<?= $totalActiveGovScholar ?>
										</h6>

									</div>
								</div>

							</div>
						</div>

					</div>

					<div class="col-xxl-4 col-xl-12">

						<div class="card info-card customers-card">

							<div class="card-body">
								<a href="<?= base_url('admin/scholar/activepri') ?>" class="text-decoration:none">
									<h5 class="card-title">Active Private Scholarships</span></h5>
								</a>

								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-coin"></i>
									</div>
									<div class="ps-3">
										<h6>
											<?= $totalActivePrivateScholar ?>
										</h6>

									</div>
								</div>

							</div>
						</div>

					</div>
					<!-- End Customers Card -->


					<div class="col-xxl-4 col-xl-12">
						<div class="card info-card customers-card">
							<div class="card-body">
								<a href="<?= base_url('admin/grantes/govgrantee') ?>" class="text-decoration:none">
									<h5 class="card-title">Government Grantee(s)</span></h5>
								</a>
								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-person-check"></i>
									</div>
									<div class="ps-3">
										<h6>
											<?= $totalGovernmentStudent ?>
										</h6>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xxl-4 col-xl-12">
						<div class="card info-card customers-card">
							<div class="card-body">
								<a href="<?= base_url('admin/grantes/prigrantee') ?>" class="text-decoration:none">
									<h5 class="card-title">Private Grantee(s)</span></h5>
								</a>
								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-person-fill-lock"></i>
									</div>
									<div class="ps-3">
										<h6>
											<?= $totalPrivateStudent ?>
										</h6>

									</div>
								</div>
							</div>
						</div>
					</div>


					<!-- Reports -->
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Reports</h5>


								<div class="row mb-3">
									<div class="col-md-3">
										<label for="type1">Scholarship Type</label>
										<select class="form-select" name="type1" id="type1" required>
											<option value="">Choose below....</option>
											<option value="0">Government</option>
											<option value="1">Private</option>
										</select>
									</div>
									<?php if (in_array($user['type_id'], [1, 2])): ?>
									<div class="col-md-3" id="scholarship_container">
										<label for="scholarship_id1">Recipient</label>
										<select class="form-select" name="scholarship_id1" id="scholarship_id1"
											required>
											<option value="">All</option>
										</select>
									</div>
									<?php endif; ?>
									<div class="col-md-3">
										<label for="school_year">School year</label>
										<select class="form-control" name="school_year" required id="school_year">
											<option selected value="">All</option>
											<?php foreach ($years as $year) : ?>
											<option value="<?= $year['school_year'] ?>">
												<?= $year['school_year'] ?>
											</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<canvas id="barChart" style="max-height: 400px;"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
</main>

<?php if ($user['type_id'] == 1 || $user['type_id'] == 2): ?>
	<script>
    let chartInstance;
    let allCampuses = []; // Array to store all campus names

    function fetchChartData() {
        var scholarship_id = $('#scholarship_id1').val();
        var school_year = $('#school_year').val();
        var selectedSourcesName = $('#scholarship_id1 option:selected').text(); // Get the selected source name

        $.ajax({
            url: "<?= base_url('Dashboard/getCampusStudentData') ?>",
            method: "GET",
            data: {
                scholarship_id: scholarship_id,
                school_year: school_year
            },
            success: function (data) {
                try {
                    var response = JSON.parse(data);
                    var labels = [];
                    var counts = [];

                    // Extract labels (campus names) and counts from the response
                    response.forEach(function (item) {
                        labels.push(item.campus_name);
                        counts.push(item.student_count);
                    });

                    // If allCampuses is empty, initialize it with the current labels
                    if (allCampuses.length === 0) {
                        allCampuses = labels.slice(); // Copy labels array
                    }

                    if (chartInstance) {
                        chartInstance.destroy();
                    }

                    var label = selectedSourcesName + ' / ' + school_year; // Customize this based on your requirement

                    // Chart configuration
                    var chartConfig = {
                        type: 'bar',
                        data: {
                            labels: allCampuses, // Use allCampuses as fixed labels
                            datasets: [{
                                label: 'Student Count',
                                data: counts,
                                backgroundColor: [
                                    'maroon',
                                    'green',
                                    'gray',
                                    'blue',
                                    // ... (more colors if needed)
                                ],
                                borderColor: [
                                    'maroon',
                                    'green',
                                    'gray',
                                    'blue',
                                    // ... (more colors if needed)
                                ],
                            }]
                        },
                        options: {
                            plugins: {
                                title: {
                                    display: true,
                                    text: label // Set the chart title
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            ticks: {
                                stepSize: 1
                            }
                        }
                    };

                    // Create the chart instance
                    chartInstance = new Chart(document.querySelector('#barChart'), chartConfig);
                } catch (error) {
                    console.error('Error parsing data:', error);
                    // Handle parsing error
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching chart data:', error);
                // Handle AJAX error
            }
        });
    }

    $(document).ready(function () {
        $('#scholarship_id1, #school_year').change(fetchChartData);
        fetchChartData(); // Fetch initial data without filters
    });
</script>

<?php endif; ?>

<?php if ($user['type_id'] == 3): ?>
<script>
	$(document).ready(function () {
		function generateRandomColor() {
			var r = Math.floor(Math.random() * 256);
			var g = Math.floor(Math.random() * 256);
			var b = Math.floor(Math.random() * 256);
			return 'rgba(' + r + ',' + g + ',' + b + ')';
		}

		function updateChart() {
			var type1 = $('#type1').val();
			var school_year = $('#school_year').val();

			$.ajax({
				url: '<?= base_url("Dashboard/getStudents"); ?>',
				type: 'GET',
				data: {
					type1: type1,
					school_year: school_year
				},
				dataType: 'json',
				success: function (response) {
					if (response.error) {
						console.error('Error in response:', response.error);
						return;
					}

					console.log('Received data:', response);
					var allLabels = [];
					var data = [];

					response.forEach(function (item) {
						allLabels.push(item.label);
						data.push(item.student_count);
					});

					var backgroundColors = [];
					var borderColors = [];
					for (var i = 0; i < data.length; i++) {
						backgroundColors.push(generateRandomColor());
						borderColors.push('rgb(255, 255, 255)');
					}

					myChart.data.labels = allLabels;
					myChart.data.datasets[0].data = data;
					myChart.data.datasets[0].backgroundColor = backgroundColors;
					myChart.data.datasets[0].borderColor = borderColors;
					myChart.update();
				},
				error: function (xhr, textStatus, errorThrown) {
					console.error('Error in Ajax request:', textStatus, errorThrown);
				}
			});
		}

		var ctx = document.getElementById('barChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [],
				datasets: [{
					label: [],
					data: [],
					backgroundColor: [],
					borderColor: [],
					borderWidth: 2
				}]
			},
			options: {
				responsive: true,
				plugins: {
					title: {
						display: false,
						text: 'Scholarship Data'
					}
				},
				scales: {
					y: {
						beginAtZero: true,
						min: 0,
						ticks: {
							stepSize: 1
						}
					}
				}
			}
		});

		updateChart();
		$('#type1, #school_year').change(updateChart);
	});

</script>



<?php endif; ?>

<script>
	$(document).ready(function () {
		// Populate scholarship options for the first scholarship type
		$('#type1').change(function () {
			var type1 = $(this).val();
			$.ajax({
				url: "<?php echo base_url('students/getScholars'); ?>",
				type: "post",
				data: {
					type: type1
				},
				success: function (response) {
					$('#scholarship_id1').html(response);
				}
			});
		});


		// Load scholarship options on page load if types are already selected
		if ($('#type1').val() !== "") {
			$('#type1').trigger('change');
		}
	});

</script>
