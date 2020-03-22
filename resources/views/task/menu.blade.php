@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">    
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}" href="{{ route('tasks.index') }}">{{ __('All Tasks') }}</a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('task_statuses.index') ? 'active' : '' }}" href="{{ route('task_statuses.index') }}">{{ __('Statuses') }}</a>
                </li>                 
            </ul>
        </div>    
            @yield('menu_content')
    </div> 
    @yield('results')    
</div> 
@endsection
