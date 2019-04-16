@extends('layouts.app')


@section('content')
<div class="page-content row"> 
<div class="page-content-wrapper m-t">
<div class="sbox  " style="border-top: none">
    <div class="sbox-title"> <b>Sample Dashboard <small> Just change any content here with real data </small></b></div>
    <div class="sbox-content"> 

        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                  <label for="sel1">Clients:</label>
                  <select class="form-control" id="c_id">
                    <option selected value="0">Please Select</option>
                    @foreach($clients as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="spanel">
                    <div class="panel-heading"> Approved Budget <b>VS</b> Utilized Budget </div>
                    <div class="panel-body">
                        <div>
                            <canvas id="barOptions" height="140"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div> 

<script type="text/javascript" src="{{ asset('sximo5/js/plugins/chartjs/Chart.min.js') }}"></script>
<script>

    $(function () {

        // /**
        //  * Options for Bar chart
        //  */
        // var barOptions = {
        //     scaleBeginAtZero : true,
        //     scaleShowGridLines : true,
        //     scaleGridLineColor : "rgba(0,0,0,.05)",
        //     scaleGridLineWidth : 1,
        //     barShowStroke : true,
        //     barStrokeWidth : 1,
        //     barValueSpacing : 5,
        //     barDatasetSpacing : 1,
        //     responsive:true
        // };

        // /**
        //  * Data for Bar chart
        //  */
        // var barData = {
        //     labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        //     datasets: [
        //         {
        //             label: "My First dataset",
        //             fillColor: "rgba(220,220,220,0.5)",
        //             strokeColor: "rgba(220,220,220,0.8)",
        //             highlightFill: "rgba(220,220,220,0.75)",
        //             highlightStroke: "rgba(220,220,220,1)",
        //             data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100]
        //         },
        //         {
        //             label: "My Second dataset",
        //             fillColor: "rgba(98,203,49,0.5)",
        //             strokeColor: "rgba(98,203,49,0.8)",
        //             highlightFill: "rgba(98,203,49,0.75)",
        //             highlightStroke: "rgba(98,203,49,1)",
        //             data: [50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50]
        //         }
        //     ]
        // };

        // var ctx = document.getElementById("barOptions").getContext("2d");
        // var myNewChart = new Chart(ctx).Bar(barData, barOptions);

        $( "select" ) .change(function () {   

            var c_id = $('#c_id').val(); 
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ url('/client_data') }}",
                method: 'post',
                data: { c_id : c_id },
                success: function (result) {
                    if(result.length > 0){

                        var budget = new Array(0,0,0,0,0,0,0,0,0,0,0,0);
                        var utilized = new Array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);

                        for (var i = 0; i < result.length; i++) {
                            budget.splice(result[i].Months -1 , 1, result[i].Budget);
                            utilized.splice(result[i].Months -1, 1, result[i].Utilized);
                        }
                        
                        /**
                        * Options for Bar chart
                        */
                        var barOptions = {
                            scaleBeginAtZero : true,
                            scaleShowGridLines : true,
                            scaleGridLineColor : "rgba(0,0,0,.05)",
                            scaleGridLineWidth : 1,
                            barShowStroke : true,
                            barStrokeWidth : 1,
                            barValueSpacing : 5,
                            barDatasetSpacing : 1,
                            responsive:true
                        };

                        /**
                        * Data for Bar chart
                        */
                        var barData = {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                            datasets: [
                                {
                                    label: "My First dataset",
                                    fillColor: "rgba(220,220,220,0.5)",
                                    strokeColor: "rgba(220,220,220,0.8)",
                                    highlightFill: "rgba(220,220,220,0.75)",
                                    highlightStroke: "rgba(220,220,220,1)",
                                    data: budget
                                },
                                {
                                    label: "My Second dataset",
                                    fillColor: "rgba(98,203,49,0.5)",
                                    strokeColor: "rgba(98,203,49,0.8)",
                                    highlightFill: "rgba(98,203,49,0.75)",
                                    highlightStroke: "rgba(98,203,49,1)",
                                    data: utilized
                                }
                            ]
                        };

                        var ctx = document.getElementById("barOptions").getContext("2d");
                        var myNewChart = new Chart(ctx).Bar(barData, barOptions);
                    } else {
                        alert('There is no client data.');
                        location.reload();
                    }
                    
                }
            });
        }); 
    });

</script>
  
                     
@stop