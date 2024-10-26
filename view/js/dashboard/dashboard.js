function getLineGraphData() {
    $.ajax({
        url: '../../controller/dashboard/getLineChartData.php',
        type: 'GET',
        success: function (data) {
            // Initialize empty arrays for labels and data
            var labels = [];
            var applicantsData = [];

            // Loop through the returned data to populate the labels and data arrays
            data.forEach(function(item) {
                labels.push(item.date); // Add date to labels
                applicantsData.push(parseInt(item.total_applicants)); // Add total applicants, converting to an integer
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels, // Use the labels array
                    datasets: [{
                        label: 'Number of Applicants',
                        data: applicantsData, // Use the applicantsData array
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        tension: 0.2,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data: ", error);
        }
    });
}

function getApplicantCountByStatus() {
    $.ajax({
        url: '../../controller/dashboard/getApplicantCountByStatus.php',
        type: 'GET',
        success: function (response) {
            const data = JSON.parse(response);

            $("#totalApplicants").text(data.totalApplicants);
            $("#acceptedCount").text(data.acceptedCount);
            $("#rejectedCount").text(data.rejectedCount);
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data: ", error);
        }
    });
}
