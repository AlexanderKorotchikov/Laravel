@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display: flex">
                    <span><a class="nav-link" href="{{ url('/') }}">Список контактов</a></span>
                    <span><a class="nav-link" href="{{ route('list-favorites') }}">{{ __('Список избранных') }}</a></span>
                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table>
                            <tr>
                                <td>id</td>
                                <td>name</td>
                                <td>phone</td>
                                <td>address</td>
                                <td>favorites</td>
                            </tr>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{$contact['id']}}</td>
                                    <td>{{$contact['name']}}</td>
                                    <td>{{$contact['phone']}}</td>
                                    <td>{{$contact['address']}}</td>
                                    <td>
                                        @if($contact['id_favorites'] == null)
                                            <button value="{{$contact['id']}}" class="addFavorites">Добавить в избранное</button>
                                        @else
                                            <button value="{{$contact['id']}}" disabled>Добавить в избранное</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
