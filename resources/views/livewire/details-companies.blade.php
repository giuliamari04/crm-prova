<main class="show-companies">

        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

    <section class="container py-3">
       <div class="d-flex justify-content-between " >
        @foreach ($companies as $company)
        <div class="d-flex align-content-center align-items-center">
             <button class="btn bottone-indietro"><a href="{{route('admin.company')}}"><i class="fa-solid fa-circle-chevron-left fs-1 "></i></a></button>
           <h2>{{$company->name}} </h2>
        </div>
        <div class="mx-4">
            <button class="btn btn-warning mx-1 " wire:click="redirectToEditPage({{ $company->id }})"><i class="fa-solid fa-user-pen"></i></button>
            <button class="btn btn-danger mx-1 " wire:click="confirmDelete({{ $company->id }})"><i class="fa-solid fa-trash-can"></i></button>
        </div>
       </div>

       <div class="mx-5">
           {{-- dettagli generali sul companye --}}
      <h4>General Info</h4>
      <table class="table py-4">
        <thead>
          <tr>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Indirizzo </th>
            <th scope="col">Settore </th>
            <th scope="col">Stato </th>
            @if ( $company->website !== null)
            <th>Sito web</th>
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td> {{$company->email}}</td>
            <td> {{$company->phone_number}}</td>
            <td>{{$company->address}},{{$company->city}},{{$company->postal_code}},{{$company->province}},{{$company->country}}</td>
            <td> {{$company->industry}}</td>
            <td>{{$company->status}}</td>
            @if ( $company->website !== null)
            <td><a href="#">{{$company->website}}</a></td>
            @endif
          </tr>
        </tbody>
      </table>


      <h4>Info Clienti che lavorano per quella azienda</h4>

      <table class="table py-4">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Cognome</th>
            <th scope="col">Codice fiscale</th>
            <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>
            @foreach($clients->where('company_id', $company->id) as $client)
          <tr>
            <th scope="row">{{$client->id}}</th>
            <td>{{$client->first_name}}</td>
            <td>{{$client->last_name}}</td>
            <td>{{$client->codice_fiscale}}</td>
            <td>{{$client->email}}</td>
          </tr>
          @endforeach
          @endforeach
        </tbody>
      </table>
   </div>
   </section>
</main>
