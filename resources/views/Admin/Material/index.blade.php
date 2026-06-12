@extends('Layouts.template-admin')

@section('title', 'Material')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">Dashboard</a>
            </li>
            {{--  <li class="breadcrumb-item">
                <a href="javascript: void(0);">Apps</a>
            </li>  --}}
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </div>
@endsection

@section('content')

@endsection
