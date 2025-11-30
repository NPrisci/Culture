@extends('layouts.app')

@section('title', 'Modifier le profil')

@section('content')

<section class="section">
    <div class="container">

        <h2 class="mb-4">Mon Profil</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row">

            <div class="col-lg-6">

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label>Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom', $user->nom) }}">
                    </div>

                    <div class="mb-3">
                        <label>Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $user->prenom) }}">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="mb-3">
                        <label>Sexe</label>
                        <select name="sexe" class="form-control">
                            <option value="">-- Choisir --</option>
                            <option value="H" {{ $user->sexe == 'H' ? 'selected' : '' }}>Homme</option>
                            <option value="F" {{ $user->sexe == 'F' ? 'selected' : '' }}>Femme</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Date de naissance</label>
                        <input type="date" name="date_naissance" class="form-control"
                               value="{{ old('date_naissance', $user->date_naissance) }}">
                    </div>

                    <div class="mb-3">
                        <label>Langue</label>
                        <select name="id_langue" class="form-control">
                            <option value="">-- choisir --</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id_langue }}"
                                    {{ $user->id_langue == $langue->id_langue ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Photo de profil</label>
                        <input type="file" name="photo" class="form-control">
                        @if($user->photo)
                            <img src="{{ asset('uploads/photos/'.$user->photo) }}" 
                                 width="120" class="mt-2 rounded">
                        @endif
                    </div>

                    <button class="btn btn-primary" type="submit">Mettre à jour</button>
                </form>

            </div>

        </div>
    </div>
</section>

@endsection
