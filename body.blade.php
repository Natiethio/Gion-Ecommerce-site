<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-eZP+7I5CZLwVv9Yh5Se5QV8vFW3pEwBn6jDbO1u4JZQg1C+uZ0qOZ3YveOjG/Jf9" crossorigin="anonymous">
</head>
<div class="main-panel">
  <div class="content-wrapper">

    <div class="row">
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$product}}</h3>

                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                  </span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Product</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$order}}</h3>

                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-receipt icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Order</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$customer}}</h3>

                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-account icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Customer</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$admin}}</h3>

                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-account-circle icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Admin User</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$revenue}} ETB</h3>

                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-currency-usd icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Revenue</h6>
          </div>

        </div>
      </div>
     
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$deliverd}}</h3>

                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-truck-delivery icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Order Deliverd</h6>
          </div>

        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$processing}}</h3>

                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-danger">
                  <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Order Processing</h6>
          </div>

        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$comment}}</h3>

                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-comment-text-outline icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Comments</h6>
          </div>

        </div>
      </div>
      <div class="row mb-5">
        <div class="col-md-6">
          <canvas id="revenueChart" class="mb-5"></canvas>
        </div>
        <div class="col-md-6">
         <canvas id="revenueyearChart"></canvas>
        </div>
      </div>
     <div class="row">
      <div class="col-md-6">
        <canvas id="categoryChart"></canvas>
      </div>
      <div class="col-md-6">
        <canvas id="quantityChart"></canvas>
      </div>
     </div>
    </div>
   </div>
  </div> 
 </div>
</div>
</div>
  
  

</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Gion.com 2023</span>

  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var revenueData = {!! json_encode($revenueData) !!};
    var monthLabels = {!! json_encode($monthLabels) !!};
    var yearLabels = {!! json_encode($yearLabels) !!};
    var currentYear = {!! json_encode($currentYear) !!};
    var previousYear = {!! json_encode($previousYear) !!};

    var combinedLabels = monthLabels.map(function (month, index) {
        if (yearLabels[index] === currentYear || yearLabels[index] === previousYear) {
            return month + ' ' + yearLabels[index];
        } else {
          return month + ' ' + yearLabels[index];
        }
    });

    var ctx = document.getElementById('revenueChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: combinedLabels,
            datasets: [{
                label: 'Two Year Time Month Revenues',
                data: revenueData,
                fill: false,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<script>
    var revenueData = {!! json_encode($revenueDatayear) !!};
    var yearLabels = {!! json_encode($yearLabelsyear) !!};

    var ctx = document.getElementById('revenueyearChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: yearLabels,
            datasets: [{
                label: 'Total Year Revenues',
                data: revenueData,
                // fill: false,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
        var productTitles = @json($producteachTitles);
        var quantities = @json($quantitieseach);

        var ctx = document.getElementById('quantityChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: productTitles,
                datasets: [{
                    label: 'Ordered Quantity',
                    data: quantities,
                    borderColor: 'blue',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

<script>
    var categoryPercentages = {!! json_encode($categoryPercentages) !!};
    var categoryNames = {!! json_encode($categoryNames) !!};

    var ctx = document.getElementById('categoryChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: categoryNames,
            datasets: [{
                label: 'Category Percentage',
                data: categoryPercentages,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(255, 0, 0, 0.8)',
                    'rgba(0, 255, 0, 0.8)',
                    'rgba(0, 0, 255, 0.8)',
                    'rgba(128, 128, 128, 0.8)',
                    'rgba(255, 255, 0, 0.8)',
                    'rgba(0, 255, 255, 0.8)'
                    // Add more colors if needed
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
</div>