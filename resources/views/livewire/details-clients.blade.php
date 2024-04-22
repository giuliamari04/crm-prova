<main class="show-clients">
    <section class="container py-3">
       <div class="d-flex align-content-center align-items-center">
        @foreach ($clients as $client)
           <button class="btn bottone-indietro"><a href="{{route('admin.home')}}"><i class="fa-solid fa-circle-chevron-left fs-1 "></i></a></button>
           <h2>{{$client->first_name}}{{$client->last_name}}</h2>
       </div>
       <div class="mx-5">
           {{-- dettagli generali sul cliente --}}
      <h4>General Info</h4>
      <ul>
       <li>
       <span>codife fiscale:</span> {{$client->codice_fiscale}}
       </li>
      <li><span>e-mail:</span> {{$client->email}}</li>
      <li><span>numero di telefono:</span>  {{$client->phone}}</li>
      <li><span>indirizzo di residenza:</span> {{$client->address}},{{$client->city}},{{$client->postal_code}},{{$client->province}},{{$client->country}}</li>
      <li><span>settore aziendale:</span>  {{$client->industry}}</li>
      @if ( $client->p_iva !== null)
       <li>
           <span>partita iva:</span>  {{$client->p_iva}}
       </li>
       @endif
      <li><span>stato:</span> {{$client->status}}</li>
      @if ( $client->contract_start_date !== null)
      <li>
       <span>Data inizio contratto:</span>  {{$client->contract_start_date}}
      </li>
      @endif
      @if ( $client->contract_end_date !== null)
      <li>
       <span>Data fine contratto:</span>  {{$client->contract_end_date}}
      </li>
      @endif
      </ul>
      @endforeach
      <h4>Company info</h4>
      <ul>
       @foreach($companies as $company)
       <li>
           nome: {{$company->name}}
       </li>
       <li>
           e-mail: {{$company->email}}
       </li>
       <li>
           numero di telefono: {{$company->phone_number}}
       </li>
       <li>
           settore azienda: {{$company->industry}}
       </li>
       <li>
          Info sede aziendale: {{$company->address}}, {{$company->city}}, {{$company->postal_code}}, {{$company->province}}, {{$company->country}}
       </li>
       @if ( $company->website !== null)
       <li>
       sito web: <a href="">{{$company->website}}</a>
       </li>
       @endif
       <li>
          stato: {{$company->status}}
       </li>
       @endforeach
   </ul>
   </div>
   </section>
</main>
