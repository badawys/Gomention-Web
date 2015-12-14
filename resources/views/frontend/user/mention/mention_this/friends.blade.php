@extends('frontend.layouts.master-small')

@section('after-styles-end')

    <link rel="stylesheet" href="{!!asset('css/select2.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('css/select2-bootstrap.min.css')!!}">

@endsection

@section('content')

    <div class="row-fluid">

        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">

            {!! Form::open(['route' => 'mention.this.do', 'method' => 'post', 'role' => 'form']) !!}
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-bottom: none;">
                        <textarea name="text" class="form-control" rows="1" placeholder="Type anything.."></textarea>
                    </div>
                    <div class="panel-body" onclick="window.open('{{ $data['url'] }}','_blank')" style="cursor: pointer;">
                        <img style="width: 15px; height: 15px;" src="{{ $data['favicon_url'] }}"/>
                        <a>{!! $data['title'] !!}</a>
                        <p>{!! str_limit($data['description'], 200) !!}</p>
                    </div>
                </div>

                <div class="form-group">
                    <select multiple="multiple" name="friends[]" id="friends-select" class="friends-select form-control select2-multiple" style="width: 100%;"> </select>
                </div>

                <button type="submit" class="btn btn-primary">Mention</button>
            {!! Form::close() !!}



        </div>
    </div>

@endsection


@section('after-scripts-end')

    <script src="{!!asset('js/select2.min.js')!!}"></script>
    <script>
        $("#friends-select").select2({
            data: friendsArray,
            theme: "bootstrap",
            placeholder: "Select Friends..."
        });
    </script>

@endsection