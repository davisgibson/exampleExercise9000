@extends('layouts.app')

@section('content')
<div class="col-lg-8 col-md-10 col-12 mx-auto">
	<div class="d-flex justify-content-between align-items-center">
		<h4>Examples</h4>
		<form method="GET" action="/" class="d-inline-block">
			<select class="form-select" onchange="this.form.submit()" name="sort">
				<option value="DateDesc" {{ request()->sort == "DateDesc" ? 'selected' : '' }}>Date Added: newest to oldest</option>
				<option value="DateAsc" {{ request()->sort == "DateAsc" ? 'selected' : '' }}>Date Added: oldest to newest</option>
				<option value="TitleAsc" {{ request()->sort == "TitleAsc" ? 'selected' : '' }}>Title: A - Z</option>
				<option value="TitleDesc" {{ request()->sort == "TitleDesc" ? 'selected' : '' }}>Title: Z - A</option>
				<option value="Approved" {{ request()->sort == "Approved" ? 'selected' : '' }}>Approved first</option>
				<option value="NotApproved" {{ request()->sort == "NotApproved" ? 'selected' : '' }}>Approved Last</option>
			</select>
		</form>
		<div class="d-flex">
			<form method="GET" action="/examples/download" class="d-inline-block">
				<button class="btn btn-outline-primary btn-sm mx-2">Export to CSV</button>
			</form>
			<div></div>
			<a href="/examples/create" class="btn btn-primary btn-sm">New Example</a>
		</div>
	</div>
	<div class="card card-body mt-2">
		<table class="table">
			<thead>
				<tr>
					<th>title</th>
					<th>url</th>
					<th>date added</th>
					<th class="text-center">is approved</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($examples as $example)
					<tr>
						<td>{{ $example['Title'] }}</td>
						<td><a href="{{ $example['Url'] }}">{{ $example['Url'] }}</a>
						<td>{{ \Carbon\Carbon::parse($example['Date Added'])->diffForHumans() }}</td>
						<td class="text-center">{{ $example['Is Approved'] }}</td>
						<td><a href="/examples/{{ $example['id'] }}/edit">edit</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection