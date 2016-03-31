@extends('frontend.layouts.master-small')

@section('content')

    <div class="row-fluid">

        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">

            <a href="#" onclick="window.close();" class="btn btn-primary btn-block" style="margin-bottom: 15px;" >Close Window</a>

        </div>
    </div>

    <script>
        window.close();
    </script>

@endsection
