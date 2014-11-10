@extends('layouts.default')

@section('content')
    <h2>This is the content from extend page.</h2>

    @foreach ($testData as $d) 
    	{{ $d->created_at }}
    @endforeach

    {{ $testData->links() }}
@stop