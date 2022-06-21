@extends('layouts.appAdmin')

@section('title', 'ADMIN DASHBOARD -')

@section('content')
    <!-- main -->
    <main class="mt-5 pt-3">
        {{-- howdy notification --}}
        @if (Session::get('howdy'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast hide border border-dark shadow-lg " role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                <img src="{{ asset('img/logo 1.png') }}" class="rounded me-2" width="32" height="24">
                <strong class="me-auto" style="font-family: 'Fira Sans Condensed', sans-serif;">Flip Flop Backend</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body text-dark fw-bold" style="font-family: 'Fira Sans Condensed', sans-serif;">
                {{ Session::get('howdy') }}&#128515;
              </div>
            </div>
          </div>
        @endif

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="adminHeading">
                        DASHBOARD
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-dark h-100 text-center">
                        <div class="card-header" style="font-size: 20px;"><i class="bi bi-bag-plus me-2"></i>ITEMS</div>
                        <div class="card-body">
                            <p class="card-text">
                            <div class="numb1 counterText counter" data-count="{{ $items }}">
                                0
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-dark h-100 text-center">
                        <div class="card-header" style="font-size: 20px;"><i class="bi bi-box me-2"></i>ORDERS</div>
                        <div class="card-body">
                            <p class="card-text">
                            <div class="numb2 counterText counter " data-count="{{ $orders }}">
                                0
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-dark h-100 text-center">
                        <div class="card-header" style="font-size: 20px;"><i class="bi bi-truck me-2"></i>DELIVERS</div>
                        <div class="card-body">
                            <p class="card-text">
                            <div class="numb3 counterText counter" data-count="{{ $delivers }}">
                                0
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-dark h-100 text-center">
                        <div class="card-header" style="font-size: 20px;"><i
                                class="bi bi-file-post-fill me-2"></i>REVIEWS</div>
                        <div class="card-body">
                            <p class="card-text">
                            <div class="numb4 counterText counter" data-count="{{ $reviews }}">
                                0
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 ">
                    <div class="card">
                        <div class="card-header"><i class="bi bi-bootstrap-fill me-2"></i>BRANDS</div>
                        <div class="card-body">
                            <canvas class="chart" width="400" height="200" id="brandchart"></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><i class="bi bi-graph-up-arrow me-2"></i>INCOME</div>
                        <div class="card-body">
                            <canvas class="chart" width="400" height="200" id="salsechart"></canvas>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header"><i class="bi bi-box me-2 me-2"></i>ORDERS</div>
                        <div class="card-body">
                            <canvas class="chart" width="400" height="200" id="orderChart"></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header"><i class="bi bi-truck me-2"></i>DELIVERS</div>
                        <div class="card-body">
                            <canvas class="chart" width="400" height="200" id="deliversChart"></canvas>
                        </div>
                    </div>
                </div> 
            </div>
    </main> 
  
@endsection

@section('javascript')

    @if (Session::get('howdy'))
        <script>
        $( window ).on( "load", function() {
            $('.toast').toast('show');
        });
        </script>
    @endif



    <script type="text/javascript">
         
        $('.counter').each(function () {
            
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({ countNum: $this.text() }).animate({
                countNum: countTo
            },
            {
                duration: 500,
                easing: 'linear',
                step: function () {
                    $this.text(Math.floor(this.countNum) + '+');
                },
                complete: function () {
                    $this.text(this.countNum + '+');
                }
            });
        });


        // brandChart
        const charts1 = document.querySelectorAll("#brandchart");

        charts1.forEach(function (chart) {
            var cData = <?php echo json_encode($brand_chart_data)?>;
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: cData.label,
                    datasets: [
                        {
                            label: "# of items",
                            data: cData.data,
                            backgroundColor: [
                                "rgba(54, 162, 235, 0.10)",
                            ],
                            borderColor: [
                                "rgba(54, 162, 235, 1)",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        },
                    },
                },
            });
        });


        // salses chart
        const charts2 = document.querySelectorAll("#salsechart");

        charts2.forEach(function (chart) {
            var cData = <?php echo json_encode($sales_chart_data)?>;
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: cData.label,
                    datasets: [
                        {
                            label: new Date().getFullYear() + " Income",
                            data: cData.data, 
                            borderColor: [
                                "rgba(0, 0, 0)",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    }, 
                },
            });
        });


        // orders
        const charts3 = document.querySelectorAll("#orderChart");

        charts3.forEach(function (chart) {
            var cData = <?php echo json_encode($orders_chart_data)?>;
            var ctx = chart.getContext("2d");

            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels:cData.label,
                    datasets: [
                        {
                            label: new Date().toLocaleString('default', { month: 'long' })+" Orders",
                            data: cData.data,
                            borderColor: [
                                "rgb(255,0,0)",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        },
                    },
                },
            });
        });

        // delivers
        const charts4 = document.querySelectorAll("#deliversChart");

        charts4.forEach(function (chart) {
            var cData = <?php echo json_encode($delivers_chart_data)?>;
            console.log(cData);
            var ctx = chart.getContext("2d");

            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels:cData.label,
                    datasets: [
                        {
                            label: new Date().toLocaleString('default', { month: 'long' })+" Completed Delivers",
                            data: cData.data,
                            borderColor: [
                                "rgb(0,128,0)",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        },
                    },
                },
            });
        });

    </script>
@endsection
     