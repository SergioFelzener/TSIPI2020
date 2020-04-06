@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.notifications.read.all') }}" class="btn btn-lg btn-success">Marcar todas como lidas</a>
        <hr>
    </div>

</div>
    <table class="table table-striped table-dark">
        <thead>
            <tr class="table-active">
                <th>ID</th>
                <th>Notificação</th>
                <th>Criado em</th>
                <th>Açoes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($unreadNotifications as $notifications)
                <tr>
                    <td>{{$notifications->id}}</td>
                    <td>{{$notifications->data['message']}}</td>
                    <td>{{$notifications->created_at->format('d/m/Y H:i:s')}}</td>
                    <td>
                        <a href="{{ route('admin.notifications.read', ['notification' => $notifications->id])}}" class="btn btn-sm btn-success float-left mr-2">Marcar como lida</a>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="3">
                    <div class="alert alert-warning">Nenhuma menssagem encontrada !</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>


@endsection
