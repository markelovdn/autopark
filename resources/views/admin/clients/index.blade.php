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
                    <a href="{{route('addClient')}}" class="btn btn-success" title="Добавить">Новый клиент</a>
                        <form action="{{route('clientsSearch')}}" method="post">
                            @csrf
                            <div style="display: inline; position: absolute; right: 0;">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="Найти по ФИО">
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
        </section>
            <table class="table table-borderd mb-5">
                <th>ID</th>
                <th>ФИО</th>
                <th>Авто</th>
                <th>Номер</th>
                <th>На парковку</th>
                <th>Редактировать</th>
                <th>Удалить</th>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{$client->client_id}}</td>
                        <td>{{$client->fio}}</td>
                        <td>{{$client->brand}} {{$client->model}}</td>
                        <td>{{$client->num}}</td>
                        <td>
                            @if ($client->onpark==0)
                            <a href="{{route('carParking', $client->car_id)}}" class="btn btn-success" >
                                Заезд</a>
                            @else
                                <a href="#"  class="btn btn-success disabled">
                                    На парковке</a>
                            @endif

                        </td>
                        <td><a href="{{route('client', $client->client_id)}}" class="btn btn-primary">
                                <i class="nav-icon fas fa-edit"></i>
                            </a></td>
                        <td><a href="{{route('delete', $client->client_id)}}" class="btn btn-danger">
                                <i class="nav-icon fas fa-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                    {{ $clients->links() }}
    </div>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')

@endsection
