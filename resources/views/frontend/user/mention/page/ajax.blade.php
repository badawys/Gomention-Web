<div class="panel panel-default" style="margin: 0px; width: 450px; margin: 0 auto;">
    <div class="panel-body" style="padding: 0px;">

        <div id="{{$mention->id}}" class="item col-md-12 col-sm-12 col-xs-12" style="list-style: none; padding: 0;">
			{{--@include('frontend.user.mention.page.cards.includes.header', ['mention' => $mention])--}}

			<div class="panel panel-default" style="margin: 0;">
				<div class="panel-body {{'card-body-'.$mention->type }}">
					<div class="{{'card-'.$mention->type }}">

						@if($mention->type == 'text')
							@include('frontend.user.mention.page.cards.text', ['mention' => $mention])

						@elseif($mention->type == 'link')
							@include('frontend.user.mention.page.cards.link', ['mention' => $mention])

						@elseif($mention->type == 'photo' )
							@include('frontend.user.mention.page.cards.photo', ['mention' => $mention])

						@elseif($mention->type == 'video' )
							@include('frontend.user.mention.page.cards.video', ['mention' => $mention])

						@elseif($mention->type == 'sound_cloud' )
							@include('frontend.user.mention.page.cards.sound', ['mention' => $mention])

						@endif
					</div>

					@if(isset($mention->data['text']) && $mention->data['text'] != '')
						<div class="mentionText text-{{$mention->type}}">
							<p dir="auto" style="text-align: justify;">{{($mention->data['text'])}}</p>
						</div>
					@endif

				</div>

				<div class="panel-footer" style="background-color: #ffffff; padding: 0; border: none;">

					@include('frontend.user.mention.page.cards.includes.footer', ['mention' => $mention])

					<div class="comments">

						<ul class="media-list comments-list">
							<li class="media comment">
								<div class="media-left media-top comment-user">
									<a class="comment-user-pic" href="#">
										<img class="media-object img-circle comment-user-pic-img" src="http://placehold.it/50x50">
									</a>
								</div>
								<div class="media-body">
									<h6 class="media-heading">User Name</h6>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eleifend vestibulum tincidunt. Proin aliquet mauris eu nulla semper tempus.
								</div>
							</li>

							<li class="media comment">
								<div class="media-left media-top comment-user">
									<a class="comment-user-pic" href="#">
										<img class="media-object img-circle comment-user-pic-img" src="http://placehold.it/50x50">
									</a>
								</div>
								<div class="media-body">
									<h6 class="media-heading">User Name</h6>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eleifend vestibulum tincidunt. Proin aliquet mauris eu nulla semper tempus.
								</div>
							</li>

							<li class="media comment">
								<div class="media-left media-top comment-user">
									<a class="comment-user-pic" href="#">
										<img class="media-object img-circle comment-user-pic-img" src="http://placehold.it/50x50">
									</a>
								</div>
								<div class="media-body">
									<h6 class="media-heading">User Name</h6>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eleifend vestibulum tincidunt. Proin aliquet mauris eu nulla semper tempus.
								</div>
							</li>

							<li class="media comment">
								<div class="media-left media-top comment-user">
									<a class="comment-user-pic" href="#">
										<img class="media-object img-circle comment-user-pic-img" src="http://placehold.it/50x50">
									</a>
								</div>
								<div class="media-body">
									<h6 class="media-heading">User Name</h6>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eleifend vestibulum tincidunt. Proin aliquet mauris eu nulla semper tempus.
								</div>
							</li>
						</ul>
					</div>
                    <div class="col-xs-12 new-comment">
                        <form class="col-xs-12 new-comment-form">
                            <div class="col-xs-10">
                                <textarea class="form-control" rows="1" placeholder="Add comment..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary col-xs-2"><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
				</div>
			</div>
		</div>
    </div>
	<button title="Close (Esc)" type="button" class="mfp-close" style=" position: fixed; margin: 0px 30px;font-size: 43px;">×</button>
	<script>
		autosize(document.querySelectorAll('textarea'));
	</script>
</div>
