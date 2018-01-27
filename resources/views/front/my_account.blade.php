@extends('app')
@section('content')
<div class="container">
    <div class="col-xs-12 col-sm-4" style="border: #4e219e solid 1px; height: 500px;">

    </div>
    <div class="col-xs-12 col-sm-8" style="border: #4e219e solid 1px; height: 500px;">
        <div class="col-xs-12 text-center col-sm-8 col-sm-offset-2" style="border: green solid 1px; margin-top: 10px;">
            <h4>Moje dane</h4>
        </div>
        <div class="row" style="padding: 15px;">
            <div class="col-xs-6 col-sm-6 text-left" style="border: green solid 1px; margin-top: 1px; font-size: 16px; padding: 20px;">
                Nazwa użytkownika {{$user->username}} <br>
                Email {{$user->email}} <br>
                Płeć {{$user->gender}} <br>
                Miasto {{$user->city}} <br>
                Kod pocztowy {{$user->zip_code}} <br>
                Adres {{$user->address}} <br>
                Numer telefonu {{$user->phone_number}} <br>
            </div>
            <div class="col-xs-6 col-sm-6 text-left" style="border: green solid 1px; margin-top: 1px; font-size: 16px;">
                Nazwa użytkownika {{$user->username}} <br>
                Email {{$user->email}} <br>
                Płeć {{$user->gender}} <br>
                Miasto {{$user->city}} <br>
                Kod pocztowy {{$user->zip_code}} <br>
                Adres {{$user->address}} <br>
                Numer telefonu {{$user->phone_number}} <br>
            </div>
        </div>
        <div class="col-xs-12 text-center" style="border: green solid 1px; margin-top: 1px;">
            <button>Aktualizuj dane</button>
            <button>Zmień hasło</button>
        </div>
    </div>
</div>
@stop