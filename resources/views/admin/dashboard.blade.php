@extends('layouts.appAdmin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count($checkouts)}}</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{count($users)}}</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Checkout Pelanggan</h3>

                  <div class="box-tools">
                    <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No. Order</th>
                        <th>User</th>
                        <th>Pembayaran</th>
                        <th>Total</th>
                        <th>Bukti Transfer</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    
                    @foreach($checkouts as $checkout)
                    <tbody>  
                      <tr>
                        <td>{{$checkout->id}}</td>
                        <td>{{$checkout->user->name}}</td>
                        <td>{{$checkout->bayar}}</td>
                        <td>{{$checkout->harga_total_kirim}}</td>
                        <td><img src="{{ url('uploads/bukti_transfer')}}/{{$checkout->bukti_transfer}}"></td>
                        <td>
                          <form method="POST" action="{{ url('konfirmasi') }}/{{ $checkout->id }}">
                          @csrf
                            <button type="submit" class="btn btn-success"> Konfirmasi</button>
                          </form>
                        </td>
                      </tr>
                    </tbody>
                    @endforeach
                  </table>
              
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          .
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
  </div>
@endsection