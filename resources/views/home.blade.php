@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center bg-gradient">
                    <h1 class="display-4 text-black font-weight-bold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                        {{ __('Dashboard') }}
                    </h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if (Auth::user()->role == 'owner')
                            <div class="col-md-12 mb-4">
                                <h5 class="text-success">Total Articles:
                                    <span class="badge badge-light text-dark">{{ $data['totalArticles'] }}</span>
                                </h5>
                                <h5 class="text-warning">Pending Articles:
                                    <span class="badge badge-danger text-dark">{{ $data['pendingArticles'] }}</span>
                                </h5>

                                <h5 class="mt-4">Categories:</h5>
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Total Articles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['categories'] as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td><span class="badge badge-info text-dark">{{ $category->articles_count }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="col-md-12 mb-4">
                                <h5 class="text-success">Your Total Articles:
                                    <span class="badge badge-light text-dark">{{ $data['userArticles'] }}</span>
                                </h5>
                                <h5 class="text-warning">Your Pending Articles:
                                    <span class="badge badge-danger text-dark">{{ $data['userPendingArticles'] }}</span>
                                </h5>

                                <h5 class="mt-4">Your Categories:</h5>
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Total Articles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['userCategories'] as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td><span class="badge badge-info text-dark">{{ $category->articles_count }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
