@extends('layouts.app')

@section('content')
<div class="col-lg-6 col-md-10 col-12 mx-auto">
	<div class="card card-body p-4">
		<div class="d-flex justify-content-between align-items-start">
			<h4 class="mb-4">Edit Example</h4>
			<form method="POST" action="/examples/{{ $example['id'] }}">
				@csrf
				@method('delete')
				<button class="btn btn-danger btn-sm" onclick="confirm('Are you sure you want to delete this example?');">Delete Example</button>
			</form>
		</div>
		<form method="POST" action="/examples/{{ $example['id'] }}" class="w-50">
			@csrf
			@method('put')
			<div class="form-group mb-3">
				<label for="title" class="mb-2">Title</label>
				<input type="text" name="title" id="title" class="form-control" autocomplete="off" value="{{ $example['Title'] }}" required>
			</div>
			<div class="form-group mb-3">
				<label for="url" class="mb-2">Url</label>
				<input type="url" name="url" id="url" class="form-control" autocomplete="off" value="{{ $example['Url'] }}" required>
			</div>
			<div class="form-check">
			<input type="hidden" name="is_approved" value="no">
			  <input class="form-check-input cursor-pointer" type="checkbox" id="is_approved" name="is_approved" value="yes" {{ $example['Is Approved'] == 'yes' ? 'checked' : '' }}>
			  <label class="form-check-label" for="is_approved">
			    Is Approved
			  </label>
			</div>
			<button class="btn btn-primary mt-3">Save</button>
		</form>
	</div>
</div>
@endsection