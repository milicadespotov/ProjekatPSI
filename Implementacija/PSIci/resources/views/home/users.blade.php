
@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="row" style="margin-top:15px;margin-bottom:15px;">
            <?php $i=0; ?>
        @foreach($users as $user)
                <?php $i=$i+1;?>
            <div class="col-lg-6">
                <div class="row" style="margin-bottom:15px">
                    <div class="col-lg-4">
                        @if($user->picture_path!=null)
                            <img style="width:100%" src="{{ asset('img/img/users/'.$user->picture_path) }}">
                            @else
                            <img style="width:100%" src="{{ asset('img/avatar.png') }}">
                            @endif
                    </div>
                    <div class="col-lg-8">
                        <h5>{{$user->name}} {{$user->surname}}</h5>
                        <br>
                        <input type="submit" value="Unapredi nalog" class="btn btn-transparent" data-toggle="modal" data-target="#myModal{{$i}}">

                    </div>
                </div>

                        <div class="modal" id="myModal{{$i}}" style="margin-top:15%;color:black;">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background-color:#2B2C30;color:white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="font-size:20px">Unapredjivanje naloga
                                            <button style="margin-bottom:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button></h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Da li ste sigurni da želite da unapredite ovaj nalog?</p>
                                    </div>
                                    <div class="modal-footer">

                                        <form method="post" action="{{route('confirm_admin', ['id'=>$user->id])}}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            @csrf
                                            <input type="submit" class="btn btn-transparent" value="Potvrdi"></input>
                                            <button type="button" class="btn btn-transparent" data-dismiss="modal">Odustani</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        @if($i % 2 ==0)
        </div>
        <div class="row">
            @endif

                @endforeach
    </div>
    </div>
<center>
    {{ $users->links() }}
</center>
@endsection