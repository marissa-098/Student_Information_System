
<div class="col-lg-12">
	 <div class="row">
		  <div class="page-breadcrumb col-md-4 p-t-20">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="./index.php" class="breadcrumb-link">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">College</li>
							</ol>
						</nav>
					</div>
			  <div class="col-md-8">
			  <hr>
			   <input type="text" name="filter_all" id="filter_all" class="form-control" placeholder="Search" required>
		 </div>
	</div>
	 
	   <br>
	   
	   <div class="card">
			<div class="card-block table-border-style">
				<div class="table-responsive">
					<table id="college_data" class="table table-bordered table-striped">
						<thead >
						  <tr>
							<th width="5%">Student No.</th>
							<th width="20%">Student's Name</th>
							<th width="10%">Year</th>
							<th width="25%">Address</th>
							<th width="25%">Contact</th>
							<th width="25%">Email</th>
							<th width="25%">Active</th>
							<th width="15%">Action</th>
						  </tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- Hover table card end -->
</div>
 <footer class="form-bg-inverse ">
	<div class="p-t-10 p-b-10 text-center">
		<strong>Online Student Information System</strong>
		<br>
		<p>Develop by Marissa Manrique &#169; 2023 </p>
		
	</div>
  </footer>
<style>
	table td{
		vertical-align: middle !important;
	}
    #filter_all{
        margin-left: auto;
        margin-right:auto;
    }
</style>
                        
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
 <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {
    var dataTable;

    // Initialize DataTable
    function initializeDataTable(filter_all = '') {
        dataTable = $('#college_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "searching": false, // Disable DataTable's default search
            "ajax": {
                url: "College/fetch.php",
                type: "POST",
                data: {
                    filter_all: filter_all
                }
            }
        });

        // Add a click event handler for the "Action" button
        $('#college_data tbody').on('click', '.view_result', function () {
            var studentId = $(this).data('id');
            openModal(studentId);
        });
    }

    // Add input event listener to the search input
    $('#filter_all').on('input', function () {
        var filter_all = $(this).val();
        if (dataTable) {
            dataTable.destroy(); // Destroy the existing DataTable
        }
        initializeDataTable(filter_all);
    });

    initializeDataTable(); // Initialize DataTable on page load

    function openModal(studentId) {
        // Example AJAX request (replace this with your actual implementation)
        $.ajax({
            url: 'College/get_details.php', // replace with your endpoint
            method: 'POST',
            data: {
                studentId: studentId
            },
            success: function (response) {
                // Assuming you have a modal with an ID of 'modalProfile'
                $('#modalProfile .modal-body').html(response);
                $('#modalProfile').modal('show');
            },
            error: function (xhr, status, error) {
                console.error(error);
                // Handle error appropriately
            }
        });
    }

    // ... (rest of your code)
});

</script>