<!-- home.blade.php -->

@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Welcome to Student TODO List Manager</h2>
                    <p class="lead">Stay organized and boost your productivity with our simple task management system</p>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-primary">
                            <div class="card-body text-center">
                                <h3 class="h5 card-title">Track Assignments</h3>
                                <p class="card-text">Keep track of all your course assignments and never miss a deadline again.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-success">
                            <div class="card-body text-center">
                                <h3 class="h5 card-title">Set Priorities</h3>
                                <p class="card-text">Organize tasks by priority and focus on what's most important.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-info">
                            <div class="card-body text-center">
                                <h3 class="h5 card-title">Track Progress</h3>
                                <p class="card-text">Monitor your progress and celebrate your academic achievements.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mb-4">
                    @auth
                        <a href="{{ route('manage') }}" class="btn btn-primary btn-lg">Manage My Tasks</a>
                    @else
                        <div class="d-grid gap-2 d-md-block">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-md-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        
        <div class="card mt-4 shadow-sm">
            <div class="card-body p-4">
                <h3 class="h4 mb-3">How It Works</h3>
                <div class="row">
                    <div class="col-md-6">
                        <ol class="list-group list-group-numbered mb-3">
                            <li class="list-group-item border-0">Create an account or login</li>
                            <li class="list-group-item border-0">Add your assignments and tasks</li>
                            <li class="list-group-item border-0">Set due dates and priorities</li>
                            <li class="list-group-item border-0">Track your progress</li>
                            <li class="list-group-item border-0">Complete tasks and stay on top of your coursework</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection