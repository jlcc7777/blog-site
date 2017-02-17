@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-2">
			</div>

			<div class="col-md-10 bodyContent">
				<div class="col-md-12">
					<h2>{{$article[0]->title}}</h2>
					<h4>Author: {{$article[0]->email}}</h4>
					<p style="font-size: 20px">{{$article[0]->content}}</p>
				</div>
				<div class="col-md-12 commentForm">
					<h4>Comments:</h4>
					<form method="POST" action="/view_blog">
						{!! csrf_field() !!}

						<input type="hidden" name="blogID" value="{{$article[0]->blogID}}">

						<textarea  placeholder="Write you comment here" name="content" class="form-control"></textarea>

						@if ($errors->has('content'))
                            <p class="alert alert-danger">{{$errors->first('content')}}</p>
                        @endif

						<br>
						<input type="submit" class="btn btn-primary" value="comment">
					</form>

					<div class="commentTable">
						<table class="table">
							@foreach($comments as $comment)
							<tr>
								<td>{{$comment->content}}</td>
								@if (Auth::guest() == false)
									@if($currentUser->type == 'admin')
										<td>
											<form method="POST" action="/view_blog/spamComment">
												{!! csrf_field() !!}
												<input type="hidden" name="blogID" value="{{ $article[0]->blogID }}">
												<input type="hidden" name="commentID" value="{{ $comment->commentsID}}">
												<input type="submit" class="btn btn-danger" value="spam">
											</form>
										</td>
									@endif
								@endif
							</tr>
							
							@endforeach
						</table>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection