 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <a href="{{route('reports.index')}}" class="btn btn-sm btn-outline-primary">ART Patients Graphs Reports Dashboard</a>    
               
                 </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div id="container" style="width:100%; height:400px;"></div>
                    
                        </div>
                        <div class="col-md-6">
                        
                        </div>

                    </div>

                    </div>
            </div>
        </div>
    </div>
</div>


<script>
 $(function () { 
    Highcharts.chart('container', {
    chart: {
        type: '<?php  print_r($type); ?>'
    },
    title: {
        text: '{{ $report}}'
    },
    subtitle: {
        text: 'Source:  {{ $report}}'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text:'<?php print_r($report); ?>'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [ {
        name: ' <?php  print_r($patientsname); ?>',
        data:  <?php  print_r($reportsx); ?>
       
    },{
        name:'TB',
        data:  <?php  print_r($tb); ?>
    },{
        name: ' Self-referred',
        data:  <?php  print_r($selftest); ?>
    },{
        name: ' ANC/ PMTCT ',
        data:  <?php  print_r($ancpmtct); ?>
    },{
        name: ' Medical outpatient ',
        data:  <?php  print_r($medicaloupatient); ?>
    },{
        name: ' Inpatient ward',
        data:  <?php  print_r($impatientward); ?>
    },{
        name: ' CBO- referred ',
        data:  <?php  print_r($cborefered); ?>
    }]
});
});
</script>
@endsection 
