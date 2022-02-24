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
        <form action="{{route('storeClient', $client[0]->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Клиент № {{$client[0]->id}}</h3>
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
                                <input type="text" name="fio" class="form-control" value="{{$client[0]->fio}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Пол</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="gender">
                                    <option value=""></option>
                                    <option @if($client[0]->gender=='мужской') selected @endif value="мужской">Мужской</option>
                                    <option @if($client[0]->gender=='женский') selected @endif value="женский">Женский</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Телефон</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" id="phone" class="form-control" value="{{$client[0]->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Адрес</label>
                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control" value="{{$client[0]->address}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Сохранить</button>
                    </div>
            </div>
        </form>
        @foreach($cars as $car)
        <form action="{{ route('updateCar', $car->id) }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Автомобиль</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Марка</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="brand" value="{{$car->brand}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Модель</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="model" value="{{$car->model}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Цвет</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="color" value="{{$car->color}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Гос. номер</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="num" id="num" value="{{$car->num}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Заезд</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="onpark" @if ($car->onpark==1) checked @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Выезд</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="onpark" @if ($car->onpark==0) checked @endif>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Сохранить</button>
                <div style="display: inline; position: absolute; right: 0;">
                    <a href="{{ route('deleteCar', $car->id) }}" class="btn btn-danger">Удалить автомобиль из базы</a>
                </div>

            </div>
        </div>
        </form>
        @endforeach
{{--        Новый автомобиль--}}
        <form action="{{ route('createCar') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Новый автомобиль</h3>
                    <input type="text" name="client_id" class="form-control" value="{{$client[0]->id}}" style="display: none">
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
                            <input type="text" name="num" id="num1" class="form-control">
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

    <script src="https://unpkg.com/imask"></script>
    <script>
        var element = document.getElementById('phone');
        var maskOptions = {
            mask: '+7(000)000-00-00',
            lazy: false
        }
        var mask = new IMask(element, maskOptions);
    </script>

    <script>
        var element2 = document.getElementById('num');
        var maskOptions2 = {
            mask: '#000##000RUS',
            definitions: {
                // <any single char>: <same type as mask (RegExp, Function, etc.)>
                // defaults are '0', 'a', '*'
                '#': /[A-Z]/
            },
            lazy: false
        }
        var mask2 = new IMask(element2, maskOptions2);
    </script>

    <script>
        var element2 = document.getElementById('num1');
        var maskOptions2 = {
            mask: '#000##000RUS',
            definitions: {
                // <any single char>: <same type as mask (RegExp, Function, etc.)>
                // defaults are '0', 'a', '*'
                '#': /[A-Z]/
            },
            lazy: false
        }
        var mask2 = new IMask(element2, maskOptions2);
    </script>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')
@endsection
