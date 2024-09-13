@extends('welcome')

@section('content')
    <main class="container mt-5">
        <section class="row d-flex justify-content-center">
            <div class="col-lg-7">
                <h3 class="text-center"> CREER UN UTILISATEUR</h3>
                <form action="{{route('user.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p>
                        <input type="text" class="form-control" name="nom" placeholder="votre nom..." value="{{old('nom')}}">
                        @error('nom')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <input type="email" class="form-control" name="email" placeholder="votre email..." value="{{old('email')}}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <input type="tel" class="form-control" name="tel" placeholder="votre telephone..." value="{{old('tel')}}">
                        @error('tel')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <input type="file" class="form-control" name="file" accept="image/*" placeholder="choisir un fichier">
                        @error('file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </p>
                    <p class="text-center">
                        <a href="{{route('user.show')}}">Home Page</a>
                    </p>
                    <button type="submit" class="w-100 btn btn-primary">
                        Creer
                    </button>
                </form>
            </div>
        </section>

    </main>

@endsection
