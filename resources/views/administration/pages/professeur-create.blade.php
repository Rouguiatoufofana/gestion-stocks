@extends('administration.base')


@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header p-4">
            <div class="card-title">Ajout d'un professeur</div>
        </div>
        <div class="card-body">
            <form action="{{ route('proffesseur.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="nom">Nom: </label>
                    <input class="form-control" type="text" name="nom" id="nom">
                </div>

                <div class="form-group">
                    <label for="prenom">Prenom: </label>
                    <input class="form-control" type="text" name="prenom" id="prenom">
                </div>

                <div class="form-group">
                    <label for="age">Age: </label>
                    <input class="form-control" type="number" name="age" id="age">
                </div>

                <div class="form-group">
                    <label for="genre">genre: </label>
                    <select class="form-select" name="genre" id="genre">
                        <option value="feminin">Féminin</option>
                        <option value="masculin">Masculin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe: </label>
                    <input class="form-control" type="password" name="password" id=assword">
                </div>

                <div class="form-group">
                    <label for="password">Confirmer votre mot de passe: </label>
                    <input class="form-control" type="password" name="password_confirm" id=assword">
                </div>

                <div class="card-action">
                    <button class="btn btn-success">Enregistrer</button>
                    <button class="btn btn-danger">Annuler</button>
                  </div>
            </form>
        </div>
    </div>
</div>
@endsection
