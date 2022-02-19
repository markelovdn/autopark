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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Автомобили на стоянке</h1>
                    </div>
                    <div class="col-sm-6">
                        <form action="{{route('carsSearch')}}" method="post">
                            @csrf
                            <div class="form-inline" style="display: inline; position: absolute; right: 0;">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="Найти по номеру">
                                    <div class="input-group-append">
                                        <button class="btn btn-sidebar">
                                            <i class="fas fa-search fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
            <table class="table table-borderd mb-5">
                <th>Марка - Модель</th>
                <th>Гос.номер</th>
                <th>Дата-время заезда</th>
                <th>Выезд со стоянки</th>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{$car->brand}} {{$car->model}}</td>
                        <td>{{$car->num}}</td>
                        <td>{{$car->updated_at}}</td>
                        <td><a href="{{route('outPark', $car->id)}}" class="btn btn-danger">
                                Выезд</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                    {{ $cars->links() }}
    </div>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')

@endsection
