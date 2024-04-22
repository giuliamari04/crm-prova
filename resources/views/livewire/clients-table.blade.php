<!-- resources/views/livewire/table.blade.php -->

<div>
    <section class="accordion mb-4 bordo-tabella" id="accordionPanelsStayOpenExample">
        <div class="accordion-item border-0 ">
            <h2 class="accordion-header border-0 ">
                <button class="accordion-button bg-transparent border-0  " type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseOne">
                    Pannello per filtrare dati
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <form wire:submit.prevent="refreshClients" class="d-flex flex-wrap accordion-body ">
                    <div class="container">
                        {{-- prima riga --}}
                        <div class="row py-2">
                            <div class="mx-3 col">
                                <label for="name">Nome</label><br>
                                <input type="text" id="name" class=" form-control " placeholder="Inserisci nome"
                                    wire:model.lazy="nameFilter">
                            </div>
                            <div class="mx-3 col col">
                                <label for="surname">Cognome</label><br>
                                <input type="text" id="surname" class=" form-control "
                                    placeholder="Inserisci cognome" wire:model.lazy="surnameFilter">
                            </div>
                            <div class="mx-3 col">
                                <label for="email">Email</label><br>
                                <input type="text" id="email" class=" form-control "
                                    placeholder="Inserisci email" wire:model.lazy="emailFilter">
                            </div>
                            <div class="mx-3 col">
                                <label for="phone">Numero di telefono</label><br>
                                <input type="text" id="phone" class=" form-control "
                                    placeholder="Inserisci numero di telefono" wire:model.lazy="phoneFilter">
                            </div>
                        </div>
                        {{-- seconda riga --}}
                        <div class="row py-2">
                            <div class="mx-3 col">
                                <label for="cf">Codice Fiscale</label><br>
                                <input type="text" id="cf" class=" form-control "
                                    placeholder="Inserisci codice fiscale" wire:model.lazy="cfFilter">
                            </div>

                            <div class="mx-3 col">
                                <label for="industryFilter">Settore:</label> <br>
                                <select wire:model="industryFilter" id="industryFilter" class=" form-control "
                                    wire:change="refreshClients">
                                    <option value="">Tutti</option>
                                    @if ($industries->isNotEmpty())
                                        @foreach ($industries as $industry)
                                            <option value="{{ $industry }}">{{ $industry }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mx-3 col">
                                <label for="statusFilter">Status:</label> <br>
                                <select wire:model="statusFilter" id="statusFilter" class=" form-control "
                                    wire:change="refreshClients">
                                    <option value="">Tutti</option>
                                    <option value="potenziale">Potenziale</option>
                                    <option value="attivo">Attivo</option>
                                    <option value="ex">Ex</option>
                                </select>
                            </div>
                            <div class="mx-3 col">
                                <label for="companyFilter">Azienda:</label> <br>
                                <select wire:model="companyFilter" id="companyFilter" class=" form-control "
                                    wire:change="refreshClients">
                                    <option value="">Tutti</option>
                                    @if ($companies->isNotEmpty())
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->client_id }}">{{ $company->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </section>
    <section class="bordo-tabella">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Stato</th>
                    <th>Azienda</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->first_name }}</td>
                        <td>{{ $client->last_name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->status }}</td>
                        @foreach ($companies as $company)
                            @if ($client->id === $company->client_id)
                                <td>{{ $company->name ?? 'N/A' }}</td>
                            @endif
                        @endforeach
                        <td class="d-flex">
                        <td class="d-flex">
                            <button class="btn btn-primary mx-1 " wire:click="redirectToDetailPage({{ $client->id }})"><i class="fa-solid fa-circle-info"></i></button>
                            <button class="btn btn-warning mx-1 " wire:click="redirectToEditPage({{ $client->id }})"><i class="fa-solid fa-user-pen"></i></button>
                            <button class="btn btn-danger mx-1 " wire:click="confirmDelete({{ $client->id }})"><i class="fa-solid fa-trash-can"></i></button>

                        </td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

</div>
