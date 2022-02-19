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
        <form action="{{route('create')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Клиент</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ФИО</label>
                            <div class="col-sm-10">
                                <input type="text" name="fio" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Пол</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="gender">
                                    <option value=""></option>
                                    <option  value="мужской">Мужской</option>
                                    <option value="женский">Женский</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Телефон</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Адрес</label>
                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
{{--        Новый автомобиль--}}
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Новый автомобиль</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Марка</label>
                        <div class="col-sm-10">
                            <input type="text" name="brand" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Модель</label>
                        <div class="col-sm-10">
                            <input type="text" name="model" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Цвет</label>
                        <div class="col-sm-10">
                            <input type="text" name="color" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Гос. номер</label>
                        <div class="col-sm-10">
                            <input type="text" name="num" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Заезд</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="onpark" value="1" checked>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Выезд</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="onpark" value="0">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')
@endsection
