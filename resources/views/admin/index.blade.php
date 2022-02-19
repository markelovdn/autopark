@extends('admin.layouts.dashboard')

@section('header')
    @include('admin.layouts.parts.header')
@endsection

@section('navbar')
    @include('admin.layouts.parts.navbar')
@endsection

@section('sidebar')
    @include('admin.layouts.parts.sidebar')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Всего в базе {{count($cars)}}</h3>
                        <h3>клиентов</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('clients')}}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>На парковке {{count($cars)}}</h3>
                        <h3>автомобилей</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('onPark')}}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Всего в базе {{count($allCars)}}<sup style="font-size: 20px"></sup></h3>
                        <h3>автомобилей<sup style="font-size: 20px"></sup></h3>
                    </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')
    @include('admin.layouts.parts.footer')
@endsection
