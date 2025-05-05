@extends('administration.base')


@section('content')
<div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
      <div>
        <h3 class="fw-bold mb-3">Liste des professeurs</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <a href="{{ route('proffesseur.create') }}" class="btn btn-primary btn-round">Ajouter un professeur</a>
      </div>
    </div>

    <div class="row card p-4">
        <div class="card-body">

            <div class="table-responsive">
              <table
                id="multi-filter-select"
                class="display table table-striped table-hover"
              >
                <thead>
                  <tr>
                    <th>Prénom et Nom</th>
                    <th>Genre</th>
                    <th>Matricule</th>
                    <th>Adresse email</th>
                    <th style="width: 10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($professeurs as $professeur)
                    <tr>
                        <td>{{ $professeur->prenom }} {{ $professeur->nom }}</td>
                        <td>{{ $professeur->genre == 'masculin' ? 'Masculin' : 'Féminin' }}</td>
                        <td>{{ $professeur->matricule }}</td>
                        <td>{{ $professeur->email }}</td>
                        <td>
    <div class="form-button-action">
        <!-- Bouton Editer -->
        <a href="{{ route('professeur.edit', $professeur->id) }}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Editer">
            <i class="fa fa-edit"></i>
        </a>
        
        <!-- Formulaire pour supprimer -->
        <form action="{{ route('professeur.destroy', $professeur->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')  <!-- Cette ligne simule la méthode DELETE -->
    <button type="submit" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Supprimer">
        <i class="fa fa-times"></i>
    </button>
</form>

    </div>
</td>

                    </tr>
                    @empty

                    @endforelse

                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Datatables -->
<script src="{{ asset('administration/assets/js/plugin/datatables/datatables.min.js') }}"></script>

<script>
    $(document).ready(function () {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
          this.api()
            .columns()
            .every(function () {
              var column = this;
              var select = $(
                '<select class="form-select"><option value=""></option></select>'
              )
                .appendTo($(column.footer()).empty())
                .on("change", function () {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                  select.append(
                    '<option value="' + d + '">' + d + "</option>"
                  );
                });
            });
        },
      });

      // Add Row
      $("#add-row").DataTable({
        pageLength: 5,
      });

      var action =
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $("#addRowButton").click(function () {
        $("#add-row")
          .dataTable()
          .fnAddData([
            $("#addName").val(),
            $("#addPosition").val(),
            $("#addOffice").val(),
            action,
          ]);
        $("#addRowModal").modal("hide");
      });
    });
  </script>
@endpush
