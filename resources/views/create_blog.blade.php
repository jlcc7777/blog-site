@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-10 bodyContent">
				<h1>New Blog</h1>

				<form method="POST" action="/create_blog">
					{!! csrf_field() !!}
					<input type="hidden"  name="userID" value="{{$currentUser->id}}"><br>
					<h4>Title:</h4>
					@if($articles != null)
						<input type="text" class="form-control" name="title" placeholder="title" value="{{$articles[0]->title}}" required autofocus><br>

                      	@if ($errors->has('title'))
                            <p class="alert alert-danger">{{$errors->first('title')}}</p>
                        @endif


						<h4>Content:</h4>
						<textarea class="form-control" placeholder="Write you content here" name="content" required autofocus>{{$articles[0]->content}}</textarea><br>

						@if ($errors->has('content'))
                            <p class="alert alert-danger">{{$errors->first('content')}}</p>
                        @endif

						<h4>Select Blog Status:</h4>
						<select name="status" class="form-control" selected="{{$articles[0]->status}}">

							@if($articles[0]->status == "Draft")
								<option value="Draft" selected> Draft</option>
								<option value="Published"> Publish</option>
								<option value="Archived"> Archive</option>
							@elseif($articles[0]->status == "Published")
								<option value="Draft"> Draft</option>
								<option value="Published" selected> Publish</option>
								<option value="Archived"> Archive</option>
							@elseif($articles[0]->status == "Archived")
								<option value="Draft"> Draft</option>
								<option value="Published"> Publish</option>
								<option value="Archived"selected> Archive</option>
							@endif
							
						</select><br>	
					@else
						<input type="text" class="form-control" name="title" placeholder="title" ><br>
						
						@if ($errors->has('title'))
                            <p class="alert alert-danger">{{$errors->first('title')}}</p>
                        @endif

						<h4>Content:</h4>
						<textarea class="form-control" placeholder="Write you comment here" name="content" ></textarea><br>
						
						@if ($errors->has('content'))
                            <p class="alert alert-danger">{{$errors->first('content')}}</p>
                        @endif

						<h4>Select Blog Status:</h4>
						<select name="status" class="form-control">
							<option selected disabled> Status</option>
							<option value="Draft"> Draft</option>
							<option value="Published"> Publish</option>
						</select><br>	
					@endif
					
					<input type="submit" class="btn btn-primary" name="save">
				</form>

			</div>
		</div>
	</div>
</div>
@endsection