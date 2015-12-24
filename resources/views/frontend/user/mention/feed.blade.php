@extends('frontend.layouts.master')

@section('after-styles-end')
    <link href="{!!asset('css/cards.css')!!}" rel='stylesheet' type='text/css'>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <div id="container" class="row">
                <ul class="mentions-list">
                    @foreach($mentions as $mention)
                        <li id="{{$mention->id}}" class="item col-md-4 col-sm-6 col-xs-12" style="list-style: none;   ">
                            @include('frontend.user.mention.cards.includes.header', ['mention' => $mention])

                            @if(isset($mention->data['text']) && $mention->data['text'] != '')
                                <div class="mentionText text-{{$mention->type}}">
                                    <p>{{($mention->data['text'])}}</p>
                                </div>
                            @endif

                            @if($mention->type == 'text')
                                @include('frontend.user.mention.cards.text', ['mention' => $mention])

                            @elseif($mention->type == 'link')
                                @include('frontend.user.mention.cards.link', ['mention' => $mention])

                            @elseif($mention->type == 'photo' )
                                @include('frontend.user.mention.cards.photo', ['mention' => $mention])

                            @elseif($mention->type == 'video' )
                                @include('frontend.user.mention.cards.video', ['mention' => $mention])

                            @endif

                            @include('frontend.user.mention.cards.includes.footer', ['mention' => $mention])
                        </li>
                    @endforeach
                </ul>

            </div>

            {!! $mentions->render() !!}

        </div><!-- col-md-10 -->

    </div><!-- row -->

    <div class="modal fade" id="delModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Mention</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button id="closeDelete" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="doDelete" type="button" class="btn btn-primary">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('after-scripts-end')

    <script src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.js"></script>
    <script src="{!!asset('js/imagesloaded.pkgd.min.js')!!}"></script>
    <script src="{!!asset('js/jquery.jscroll.min.js')!!}"></script>

    <script>

        //Hide pagination
        $('ul.pagination:visible:first').hide();

        $('#container').imagesLoaded().progress( function(){

            $('#container').masonry({
                // options
                columnWidth: '.item',
                itemSelector: '.item'
            })
        });

        $('.mentions-list').infinitescroll({
            navSelector  : ".pagination",
            nextSelector : ".pagination li.active + li > a",
            itemSelector : ".item",
            debug        : false

        },function(arrayOfNewElems){

            $('#container').imagesLoaded().progress(
                    $('#container')
                            .append(arrayOfNewElems)
                            .masonry('appended',arrayOfNewElems)
                            .masonry()
            );
        });

        var delId = null;
        var delSelector = null;

        $(document).on('click','.delete-mention',function(){

            delId = $(this).parents('.item').attr('id');
            delSelector = $('#'+delId);

            $('#delModel').modal('show');


        });

        $('#doDelete').click(function(){
            $.ajax({
                url: 'mention/' +delId+ '/delete',
                type: 'GET',
                success: function(result) {
                    $('#container')
                            .masonry('remove', delSelector)
                            .masonry();

                    $('#delModel').modal('hide');

                    delSelector = null;
                    delId = null;
                }
            });
        });


    </script>
@endsection
