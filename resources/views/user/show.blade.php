@extends('welcome')

@section('content')

    <main class="container-fluid mt-5">
        <section class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <a href="{{route('user.create')}}" class="btn btn-primary">
                    <i class="fas fa-user me-1"></i>
                    ajouter un user
                </a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Image</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->tel}}</td>
                                <td>
                                    <img src="{{asset('storage/imageUser/'.$user->image)}}" alt="" width="50" height="50" class="rounded-circle">
                                </td>
                                <td>
                                    <a href="{{route('user.update',['id'=>$user->id])}}">
                                        <i class="fas fa-edit text-primary me-3"></i>
                                    </a>
                                    <span data-bs-toggle="modal" data-bs-target="#a{{$user->id}}" role="button">
                                        <i class="fas fa-trash text-danger me-3"></i>
                                    </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="a{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                           voulez vous vraiment supprimer <strong>{{$user->name}}</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
                                            <a href="{{route('user.delete',['id'=>$user->id])}}" class="btn btn-primary">oui</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No Users</p>
                        @endforelse

                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}

            </div>
        </section>
    </main>

@endsection
