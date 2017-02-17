@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-10 bodyContent">
				<h2>Your {{$status}} Blogs</h2>
				<table class="table table-bordered" id="blogTable">
					<tr>
						<th>Title</th>
						<th>Date Created</th>
						<th>Date {{ $status }}</th>
						<th>Action</th>
					</tr>
					@foreach($articles as $data)
						<tr>
							<td>{{ $data->title }}</td>
							<td>{{ $data->date_created }}</td>
							<td>{{ $data->date_modified }}</td>
							<td>
								<input type="button"  onclick="location.href='/view_blog/{{ $data->blogID }}'" class="btn btn-primary"  value="View">
								<input type="button"  class="btn btn-primary"  value="Edit" onclick="location.href='/edit_blog/{{ $data->blogID }}'">
								<form method="POST" action="/my_blog/changeBlodStatus" >
									<input type="hidden" name="blogID" value="{{$data->blogID}}">
									{!! csrf_field() !!}
									@if($data->status == "Published")
										<input type="hidden" name="status" value="Archived">
										<input type="submit" class="btn btn-success" value="Archive">
									@elseif($data->status == "Draft" || $data->status == "Archived")
										<input type="hidden" name="status" value="Published">
										<input type="submit" class="btn btn-success" value="Publish">
									@endif
								</form>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
@endsection