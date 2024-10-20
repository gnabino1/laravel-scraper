@extends('welcome')
@section('title')
<title>Data Scrapping</title>
@endsection

@section('style')

@endsection

@section('main-content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Position</th>
      <th scope="col">Company</th>
      <th scope="col">Location</th>
      <th scope="col">Job Type</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>
    @foreach($jobs as $key=>$job)
    <tr>
      <th scope="row">{!! $key+1 !!}</th>
      <td>{!! $job['title'] !!}</td>
      <td>{!! $job['position'] !!}</td>
      <td>{!! $job['company'] !!}</td>
      <td>{!! $job['location'] !!}</td>
      <td>{!! $job['job_type'] !!}</td>
      <td>{!! $job['created_at'] !!}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection