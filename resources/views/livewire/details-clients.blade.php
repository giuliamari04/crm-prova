<main class="show-clients">

    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <section class="container py-3">
        <div class="d-flex justify-content-between ">
            @foreach ($clients as $client)
                <div class="d-flex align-content-center align-items-center">
                    <button class="btn bottone-indietro"><a href="{{ route('admin.home') }}"><i
                                class="fa-solid fa-circle-chevron-left fs-1 "></i></a></button>
                    <h2> Cliente: {{ $client->first_name }} {{ $client->last_name }}</h2>
                </div>
                <div class="mx-4">
                    <button type="button" class="btn btn-warning mx-1" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="modifica" wire:click="redirectToEditPage({{ $client->id }})"><i
                            class="fa-solid fa-user-pen"></i></button>
                    <button  type="button" class="btn btn-danger mx-1" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="cancella" wire:click="deleteClient({{ $client->id }})"
                        wire:confirm="Conferma Eliminazione Cliente \n \n Sei sicuro che vuoi cancellare il cliente {{ $client->first_name }} {{ $client->last_name }} dalla lista? \n \n Se sei sicuro clicca su ---> ok \n Oppure per tornare alla lista clienti clicca su ---> Annulla">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>


                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight"
                        wire:click="sendMail({{ $client->id }}) aria-controls="offcanvasRight">Manda una Mail</button>
{{-- offcanvas Mail --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel">Anteprima email</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="border border-1 border-black p-3 ">
                                <h5>Ciao {{ $client->first_name }} {{ $client->last_name }}</h5>
                                <p>Ti sto per mandare una mail! <br>
                                    Saluti Admin
                                </p>
                            </div>
                            <button class="btn btn-primary my-3 " wire:click="sendMail({{ $client->id }})">Invia
                            </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="mx-5">

{{-- dettagli generali sul cliente --}}
            <div class=" d-flex flex-wrap pt-4">
                <div class="card m-3" style="width: 18rem;">
                    <h4 class="d-flex justify-content-center pt-2">General Info</h4>
                    <div class="card-body">
                        <ul>
                            <li>
                                <span>codife fiscale:</span> {{ $client->codice_fiscale }}
                            </li>
                            <li><span>e-mail:</span> {{ $client->email }}</li>
                            <li><span>numero di telefono:</span> {{ $client->phone }}</li>
                            <li><span>indirizzo di residenza:</span>
                                {{ $client->address }},{{ $client->city }},{{ $client->postal_code }},{{ $client->province }},{{ $client->country }}
                            </li>
                            <li><span>settore aziendale:</span> {{ $client->industry }}</li>
                            @if ($client->p_iva !== null)
                                <li>
                                    <span>partita iva:</span> {{ $client->p_iva }}
                                </li>
                            @endif
                            <li><span>stato:</span> {{ $client->status }}</li>
                            @if ($client->contract_start_date !== null)
                                <li>
                                    <span>Data inizio contratto:</span> {{ $client->contract_start_date }}
                                </li>
                            @endif
                            @if ($client->contract_end_date !== null)
                                <li>
                                    <span>Data fine contratto:</span> {{ $client->contract_end_date }}
                                </li>
                            @endif
                        </ul>
                        @endforeach
                    </div>
                </div>

{{-- info azienda --}}
                <div class="card m-3" style="width: 18rem;">
                    <h4 class="d-flex justify-content-center pt-2">Company info</h4>
                    <div class="card-body">
                        <ul>
                            @foreach ($companies->where('id', $client->company_id) as $company)
                                <li><span>
                                    nome:</span> {{ $company->name }}
                                </li>
                                <li><span>
                                    e-mail:</span> {{ $company->email }}
                                </li>
                                <li><span>
                                    numero di telefono:</span> {{ $company->phone_number }}
                                </li>
                                <li><span>
                                    settore azienda:</span> {{ $company->industry }}
                                </li>
                                <li><span>
                                    Info sede aziendale:</span> {{ $company->address }}, {{ $company->city }},
                                    {{ $company->postal_code }}, {{ $company->province }}, {{ $company->country }}
                                </li>
                                @if ($company->website !== null)
                                    <li><span>
                                        sito web:</span> <a href="">{{ $company->website }}</a>
                                    </li>
                                @endif
                                <li><span>
                                    stato:</span> {{ $company->status }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>


{{-- info attività --}}
                @foreach ($activities as $activity)
                    @if (!empty($activities))
                        <div class="card mx-3" style="width: 18rem;">
                            <h4 class="d-flex justify-content-center pt-2">Attività cliente</h4>
                            <span class="text-center">codice di esecuzione <strong>{{$activity->id}}</strong> </span>
                            <div class="card-body">
                                <ul>
                                    <li><span>
                                        data attività:</span> {{ $activity->activity_date }}
                                    </li>
                                    <li><span>
                                        soggetto:</span> {{ $activity->subject }}
                                    </li>
                                    <li><span>
                                        stato:</span> {{ $activity->status }}
                                    </li>

                                </ul>
                            </div>
                        </div>
                        @else
                            <div class="card m-3" style="width: 18rem;">
                                <h4 class="d-flex justify-content-center pt-2">Attività cliente</h4>
                                <div class="card-body">
                                    <p>Non ci sono attività registrate per questo cliente</p>
                    @endif
                @endforeach




{{-- info interazioni --}}
            @foreach ($interactions as $interaction)
                @if (!empty($interactions))
                <div class="card m-3" style="width: 18rem;">
                    <h4 class="d-flex justify-content-center pt-2">Interazione cliente</h4>
                    <span class="text-center">codice di esecuzione <strong>{{$interaction->id}}</strong> </span>
                    <div class="card-body">
                    <ul>
                        <li><span>
                            tipo di interazione:</span> {{ $interaction->type }}
                        </li>
                        <li><span>
                            @if ($interaction->description !== null)
                                descrizione:</span> {{ $interaction->description }}
                            @else
                                descrizione:</span> (non disponibile)
                            @endif

                        </li>
                        <li><span>
                            data interazione: </span>{{ $interaction->date_time }}
                        </li>

                    </ul>
                </div>
                </div>
                @else
                <div class="card m-3" style="width: 18rem;">
                    <h4 class="d-flex justify-content-center pt-2">Interazione cliente</h4>
                    <div class="card-body">
                    <p>Non ci sono interazioni registrate per questo cliente</p>
                    </div>
                </div>
                @endif
            @endforeach

{{-- info financials --}}
            @foreach ($financials as $financial)
                @if (!empty($financials))
                <div class="card m-3" style="width: 18rem;">
                    <div class="d-flex  flex-column justify-content-center pt-2">
                          <h4> Attività finanziarie cliente</h4>
                        <span class="text-center">codice di esecuzione <strong>{{$financial->id}}</strong> </span>
                    </div>

                    <div class="card-body">
                    <ul>
                        <li><span>
                            numero fatttura:</span> {{ $financial->invoice_number }}
                        </li>
                        <li><span>
                            ammonto:</span> {{ $financial->amount }}
                        </li>
                        <li><span>
                            data fattura:</span> {{ $financial->due_date }}
                        </li>
                        <li><span>
                            pagamento:</span>
                            @if ($financial->paid === 1)
                                completato
                            @else
                                non completato
                            @endif
                        </li>

                    </ul>
                </div>
            </div>
                @else
                <div class="card m-3" style="width: 18rem;">
                    <h4 class="d-flex justify-content-center pt-2">Attività finanziarie cliente</h4>
                    <div class="card-body">
                    <h4>Interazione cliente</h4>
                    <p>Non ci sono interazioni registrate per questo cliente</p>
                </div>
            </div>
                @endif
            @endforeach
        </div>
    </div>
    </section>
</main>
