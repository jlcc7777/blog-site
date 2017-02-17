

@extends('layouts.app')
@section('content')
        <div id="page-content-wrapper">
			<div class="container">
			    <div class="row">
			    	<div class="col-md-2">
			    	</div>
			    	<div class="col-md-10 bodyContent">
			    		<h2>Welcome to the BLOG</h2>
						<table class="table table-bordered mainTable" id="blogTable">
							<tr>
								<th><center>Title</th>
								<th><center>Author</th>
								<th><center>Action</th>
							</tr>
							@foreach($articles as $data)
							<tr>
								<td><center>{!! $data->title !!}</td>
								<td><center>{!! $data->name !!}</td>
								<td><center>
									<input type="button"  onclick="location.href='/view_blog/{!! $data->blogID !!}'" class="btn btn-primary"  value="View">
								@if (Auth::guest())
                        		@else
									@if($currentUser->type == 'admin')
									 	<form method="POST" action="/spam_blog">
									 		{!! csrf_field() !!}
									 		<input type="hidden" name="blogID" value="{!! $data->blogID !!}">
									 		<input type="submit" class="btn btn-danger" name="status" value="Spam">
									 	</form>
									@endif
								@endif
								</td>
							</tr>
							@endforeach
						</table>
					</div>
					<script>
				       $(document).ready(function(){
						    $('#myTable').DataTable();
						});
				    </script>
				</div>
			</div>
		</div>
	</div>
@endsection

