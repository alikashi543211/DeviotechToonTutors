@extends('layouts.tutor')
@section('title', 'Payments')
@section('content')
<section class="tutor-dashboard-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Payments</h2>
                <h6>All your earnings here</h6>
            </div>
        </div>
    </div>
</section>
<section class="section-stats">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon mb-2">
                            <span class="rounded-circle"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <p class="font-weight-bold">Total Hours</p>
                        <h3>0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon mb-2">
                            <span class="rounded-circle"><i class="fa fa-money"></i></span>
                        </div>
                        <p class="font-weight-bold">Net Income</p>
                        <h3>$0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon mb-2">
                            <span class="rounded-circle"><i class="fa fa-credit-card"></i></span>
                        </div>
                        <p class="font-weight-bold">Widthrawn</p>
                        <h3>$0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-icon mb-2">
                            <span class="rounded-circle"><i class="fa fa-usd"></i></span>
                        </div>
                        <p class="font-weight-bold">Available</p>
                        <h3>$0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="table-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-right mb-3">
                <a href="javascript:void(0);" class="btn btn-default btn-small">Export CSV</a>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th width="70%">Hours</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>19-Oct-2020</td>
                                <td width="70%">50 Hrs</td>
                                <td>$50</td>
                            </tr>
                            <tr>
                                <td>10-Oct-2020</td>
                                <td width="70%">35 Hrs</td>
                                <td>$35</td>
                            </tr>
                            <tr>
                                <td>13-Oct-2020</td>
                                <td width="70%">2 Hrs</td>
                                <td>$2</td>
                            </tr>
                            <tr>
                                <td>9-Oct-2020</td>
                                <td width="70%">8 Hrs</td>
                                <td>$8</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
