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
      <ul>

      <li><span>e-mail:</span> {{$company->email}}</li>
      <li><span>numero di telefono:</span>  {{$company->phone_number}}</li>
      <li><span>indirizzo di residenza:</span> {{$company->address}},{{$company->city}},{{$company->postal_code}},{{$company->province}},{{$company->country}}</li>
      <li><span>settore aziendale:</span>  {{$company->industry}}</li>
      <li><span>stato:</span> {{$company->status}}</li>
      @if ( $company->website !== null)
      <li>
       <span>Sito Web:</span>  {{$company->website}}
      </li>
      @endif
      </ul>
      @endforeach


      {{-- @if($clients->where('company_id', $company->id)->isNotEmpty())
      <h4>Info Clienti che lavorano per quella azienda</h4>
      <ul>
          @foreach($clients->where('company_id', $company->id) as $client)
          <li>
              nome: {{$client->first_name}}
          </li>
          <li>
              cognome: {{$client->last_name}}
          </li>
          <li>
              e-mail: {{$client->email}}
          </li>
          @endforeach
      </ul>
  @else
      <p>Non ci sono clienti per questa azienda.</p>
  @endif --}}
   </ul>
   </div>
   </section>
</main>
