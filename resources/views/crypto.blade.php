@extends('final_year_project.layouts.master');
@section('content')

<div class="jumbotron">
    <div class="row">
        @foreach($response as $data)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>{{$data['currency']}}</h3>
                    <h3>{{$data['name']}}</h3>
                    <h3>{{$data['price']}}</h3>
                    <img src="https://s3.us-east-2.amazonaws.com/nomics-api/static/images/currencies/btc.svg" width="100">
                </div><!-- card body end -->

            </div><!-- card end -->
        </div> <!-- col end -->
        @endforeach
    </div> <!-- row end -->
</div> <!-- jumbo end -->


<!-- <table class="table table-hover">
    <th>id</th>
    <th>Name</th>
    <th>Roll</th>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
    </tr>
</table> -->


@endsection